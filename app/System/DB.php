<?php


namespace App\System;


use App\System\Database\DBConnection;
use PDOException;

class DB
{
    protected $connection;

    public function __construct()
    {
        $this->connection = DBConnection::connection();
    }

    public function run($query)
    {
        $insert = null;

        try {
            $insert = $this->connection->exec($query);
        } catch (PDOException $e) {
            return json($e->getMessage(), 419);
        }

        return $insert;
    }

}
