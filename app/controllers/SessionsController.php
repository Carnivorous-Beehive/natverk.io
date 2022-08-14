<?php

namespace Natverk\Controllers;

class SessionsController extends ApplicationController
{
    public function new()
    {
        $this->render('sessions/new', array('title' => 'Login'));
    }

    public function create($params)
    {
        die($params);
    }
}
