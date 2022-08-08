<?php

namespace Natverk\Controllers;

$db = require_once CONFIG_PATH . '/database.php';

class HelloController extends ApplicationController
{
    public function show($args)
    {
        $this->render('hello/show', $args);
    }
}
