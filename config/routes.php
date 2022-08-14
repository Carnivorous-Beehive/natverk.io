<?php
require_once LIB_PATH . "/CarnivorousBeehive/Router.php";
require_once LIB_PATH . "/CarnivorousBeehive/renderer.php";
require_once APP_PATH . "/controllers/require.php";

use CarnivorousBeehive\Router;

$router = new Router;

$router->assets(realpath('../public/assets'));
$router->get('/', function () { phpinfo(); });
$router->get('/users', [Natverk\Controllers\UsersController::class, 'index']);
$router->get('/users/:username', [Natverk\Controllers\UsersController::class, 'show']);
$router->get('/register', [Natverk\Controllers\UsersController::class, 'new']);
$router->post('/users', [Natverk\Controllers\UsersController::class, 'create']);
$router->get('/login', [Natverk\Controllers\SessionsController::class, 'new']);
$router->post('/sessions', [Natverk\Controllers\SessionsController::class, 'create']);

$router->notFound(function () {
    render_view('404');
});

$router->error(function ($e) {
    render_view('500', array('error' => $e));
});

return $router;
