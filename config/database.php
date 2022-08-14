<?php

class Database
{
    private static PDO $database;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception('Cannot deserialize a PDO connection');
    }

    public static function getInstance(): PDO
    {
        if (!isset(static::$database)) {
            $host = getenv('DB_HOST');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');
            $name = getenv('DB_NAME');
            $port = getenv('DB_PORT');
            self::$database = new PDO("mysql:host=$host;port=$port;dbname=$name;", $user, $pass);
        }

        return self::$database;
    }
}
