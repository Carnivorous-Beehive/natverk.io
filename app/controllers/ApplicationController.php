<?php

namespace Natverk\Controllers;

use RuntimeException;

require_once LIB_PATH . '/CarnivorousBeehive/renderer.php';

abstract class ApplicationController
{
    protected $layout;

    public function render(string $path, array $params = array())
    {
        render_view(
            template: $path,
            params: $params,
            layout: $this->getLayout(),
            sitename: 'Natverk.io',
        );
    }

    public function validateCSRF($csrf): void
    {
        if (empty($csrf) || !hash_equals($_SESSION['csrf'], $csrf)) {
            throw new \Error('Cross Site Request Forgery detected');
        }
    }

    protected function setLayout(string $layout): self
    {
        $this->layout = $layout;
        return $this;
    }

    protected function getLayout(): string
    {
        if (is_null($this->layout)) {
            return APP_PATH . '/views/layouts/application.php';
        }

        if (!file_exists($this->layout)) {
            throw new RuntimeException("'$layout' does not exist!");
        }

        return $this->layout;
    }
}
