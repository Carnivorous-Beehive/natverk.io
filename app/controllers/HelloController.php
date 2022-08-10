<?php

namespace Natverk\Controllers;

class HelloController extends ApplicationController
{
    public function show($args)
    {
        $this->render('hello/show', $args);
    }
}
