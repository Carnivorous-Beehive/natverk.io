<?php
define('APP_PATH', realpath('../app'));

$router = require_once "../config/routes.php";

$router->handle();
