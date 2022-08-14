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

$router->notFound(function () {
    render_view('404');
});

return $router;
