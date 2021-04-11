<?php


namespace App\System\Database;


use App\System\Database\Driver\MySQL;
use Exception;

class DBConnection
{
    public static $connection = null;

    public static function connection()
    {
        if (!static::$connection) {
            try {
                $driver = new MySQL();
                static::$connection = (new DatabaseManager($driver))->connect();
            } catch (Exception $e) {
                return responseJson($e->getMessage());
            }
        }
        return static::$connection;
    }
}
