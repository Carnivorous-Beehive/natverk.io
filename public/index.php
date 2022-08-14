<?php
define('APP_PATH', realpath('../app'));
define('LIB_PATH', realpath('../lib'));
define('CONFIG_PATH', realpath('../config'));

require_once APP_PATH . '/controllers/require.php';
require_once APP_PATH . '/models/require.php';
require_once APP_PATH . '/repositories/require.php';

$router = require_once "../config/routes.php";

session_start();
$router->handle();
