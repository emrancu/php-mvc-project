<?php


namespace App\System\Database\Driver;


use App\System\Database\Connection;
use App\System\Helper\EnvManager;
use PDO;
use PDOException;

class MySQL implements Connection
{
    protected $conn;
    protected $connectionStatus = '';
    protected $host, $database, $username, $password = "";

    public function connect()
    {
        $this->host = EnvManager::get('host');
        $this->database = EnvManager::get('database');
        $this->username = EnvManager::get('user');
        $this->password = EnvManager::get('password');

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname=".$this->database, $this->username,
                $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connectionStatus = "Connected";
        } catch (PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
            $this->connectionStatus = "Not Connected";
        }

        return $this->conn;
    }


}
