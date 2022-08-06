<?php

namespace Natverk\Controllers;

require_once LIB_PATH . '/CarnivorousBeehive/renderer.php';

abstract class ApplicationController
{

    public function render(string $path, array $args = array())
    {
        render_view($path, $args);
    }
}
