<?php
require_once "../lib/CarnivorousBeehive/Router.php";

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
    echo "You made it";
});
$router->notFound(function () {
    include "../public/404.php";
});

return $router;
