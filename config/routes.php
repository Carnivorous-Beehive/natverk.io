<?php
require_once "../lib/CarnivorousBeehive/Router.php";
require_once "../lib/CarnivorousBeehive/renderer.php";
require_once APP_PATH . "/controllers/require.php";

use CarnivorousBeehive\Router;

$router = new Router;

$router->assets(realpath('../public/assets'));
$router->get('/', function () { phpinfo(); });
$router->get('/hello', function ($args) {
    if (array_key_exists('name', $args)) {
        echo "Hello, " . $args['name'] . "!";
    } else {
        echo "Hello, stranger!";
    }
});
$router->get('/hello/:name', [Natverk\Controllers\HelloController::class, 'show']);
$router->notFound(function () {
    render_view('404');
});

return $router;
