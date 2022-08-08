<?php
define('APP_PATH', realpath('../app'));
define('LIB_PATH', realpath('../lib'));
define('CONFIG_PATH', realpath('../config'));

$router = require_once "../config/routes.php";

$router->handle();
