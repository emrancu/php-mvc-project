<?php


namespace App\System;


use App\System\Database\DBConnection;
use PDO;

class Model
{
    protected $connection;

    protected $table;

    public function __construct()
    {
        $this->connection = DBConnection::connection();
    }

    public function get()
    {
        $query = $this->connection->prepare("select * from {$this->table}");
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query->fetchAll();
    }

    public function first()
    {
        $query = $this->connection->prepare("select * from {$this->table} LIMIT 1");
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query->fetch();
    }


}
