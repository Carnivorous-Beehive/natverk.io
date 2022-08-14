<?php

namespace Natverk\Controllers;

use Natverk\Repositories\UsersRepository;

class SessionsController extends ApplicationController
{
    public function __construct()
    {
        $this->usersRepository = new UsersRepository;
    }

    public function new($params)
    {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        return $this->render('sessions/new', array(
            'title' => 'Login',
            'styles' => array('login'),
            'error' => array_key_exists('error', $params) ? $params['error'] : null,
        ));
    }

    public function create($params)
    {

        try {
            $this->validateCSRF($params['csrf']);

            $user = $this->usersRepository->getUserByUserName($params['username']);
            $user->validatePassword($params['password']);

            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_username'] = $user->username;
        } catch (\Error $e) {
            $_SESSION['error'] = $e->getMessage();
            http_response_code(500);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
