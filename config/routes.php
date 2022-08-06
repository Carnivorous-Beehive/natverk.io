<?php
require_once "../lib/CarnivorousBeehive/Router.php";

use CarnivorousBeehive\Router;

$router = new Router;

$router->static(realpath('../public'));
$router->get('/', function () { phpinfo(); });
$router->get('/hello', function () { echo "world"; });
$router->notFound(function () {
    include "../public/404.php";
});

return $router;
