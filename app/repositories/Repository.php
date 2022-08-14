<?php

namespace Natverk\Repositories;

require_once CONFIG_PATH . '/database.php';

use \PDO;
use \Database;

abstract class Repository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    protected function connection(): PDO
    {
        return $this->db;
    }
}
