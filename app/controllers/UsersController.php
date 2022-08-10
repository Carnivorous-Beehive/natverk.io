<?php

namespace Natverk\Controllers;

use Natverk\Repositories\UsersRepository;

class UsersController extends ApplicationController
{
    private UsersRepository $usersRepository;

    public function __construct()
    {
        // TODO: This really needs to be injeted into the controller
        include CONFIG_PATH . '/database.php';
        $this->usersRepository = new UsersRepository($db);
    }

    public function index($args)
    {
        $page = array_key_exists('page', $args) ?? (int) $args['page'];
        $size = array_key_exists('size', $args) ?? (int) $args['size'];
        $users = $this->usersRepository->getAllUsers(
            page: $page,
            size: $size,
        );

        $this->render('users/index', array('users' => $users));
    }

    public function show($params)
    {
        $this->render(
            'users/show',
            array('user' => $this->usersRepository->getUserByUsername($params['username']))
        );
    }
}
