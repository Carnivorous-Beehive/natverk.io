<?php

namespace Natverk\Controllers;

use Natverk\Repositories\UsersRepository;

class UsersController extends ApplicationController
{
    private UsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository;
    }

    public function index($params)
    {
        $page = array_key_exists('page', $params) ?? (int) $params['page'];
        $size = array_key_exists('size', $params) ?? (int) $params['size'];
        $users = $this->usersRepository->getAllUsers(
            page: $page,
            size: $size,
        );

        $this->render('users/index', array('users' => $users, 'title' => 'Users'));
    }

    public function show($params)
    {
        $user = $this->usersRepository->getUserByUsername($params['username']);
        $this->render(
            'users/show',
            array('user' => $user, 'title' => array($user->username, 'Users')),
        );
    }

    public function new()
    {
        $this->render('users/new', array('title' => 'Register'));
    }

    public function create($params)
    {
        die($params);
    }
}
