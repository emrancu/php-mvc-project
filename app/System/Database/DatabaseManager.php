<?php


namespace App\System\Database;


class DatabaseManager
{
    private $dbDriver;

    public function __construct(Connection $connection)
    {
        $this->dbDriver = $connection;
    }

    public function connect()
    {
        return $this->dbDriver->connect();
    }
}
