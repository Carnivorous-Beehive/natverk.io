<?php
require_once "../lib/CarnivorousBeehive/Router.php";
require_once "../lib/CarnivorousBeehive/renderer.php";

use CarnivorousBeehive\Router;

$router = new Router;

$router->static(realpath('../public'));
$router->get('/', function () { phpinfo(); });
$router->get('/hello', function ($args) {
    if (array_key_exists('name', $args)) {
        echo "Hello, " . $args['name'] . "!";
    } else {
        echo "Hello, stranger!";
    }
});
$router->get('/hello/:name', function ($args) {
    render_view('hello/show', $args);
});
$router->notFound(function () {
    render_view('404');
});

return $router;
