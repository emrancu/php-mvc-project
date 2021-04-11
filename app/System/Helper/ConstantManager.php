<?php


namespace App\System\Helper;


class ConstantManager
{

    public static $appRoot;
    public static $databaseConnection;

    public static function setPath($root)
    {
        static::$appRoot = $root;
    }

}
