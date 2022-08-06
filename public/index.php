<?php
define('APP_PATH', realpath('../app'));
define('LIB_PATH', realpath('../lib'));

$router = require_once "../config/routes.php";

$router->handle();
