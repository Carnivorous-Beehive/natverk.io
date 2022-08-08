<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');
$port = getenv('DB_PORT');

$db = new PDO("mysql:host=$host;port=$port;dbname=$name;", $user, $pass, array(
    PDO::ATTR_PERSISTENT => true
));
