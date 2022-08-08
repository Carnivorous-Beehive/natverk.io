<?php

namespace Natverk\Repositories;

use \PDO;

abstract class Repository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    protected function connection(): PDO
    {
        return $this->db;
    }
}
