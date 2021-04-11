<?php


namespace App\System\Helper;


class EnvManager
{

    public static $databaseConf = null;

    public static function checkEnv()
    {
        if (file_exists(ConstantManager::$appRoot."/config/db.env")) {
            return true;
        }
        return false;
    }

    public static function get($key)
    {
        if (!static::$databaseConf) {
            static::readEnvFile();
        }
        return isset(static::$databaseConf[$key]) ? static::$databaseConf[$key] : null;
    }

    public static function readEnvFile()
    {
        if (!static::$databaseConf) {

            $databaseHost = null;
            $databaseName = null;
            $databaseUserName = null;
            $databasePassword = null;

            if (file_exists(ConstantManager::$appRoot."/config/db.env")) {

                $configData = '';
                $readFile = fopen(ConstantManager::$appRoot."/config/db.env", "r");

                while (!feof($readFile)) {
                    $configData = fgets($readFile);
                    $explode = explode('=', $configData);

                    if ($explode[0] == 'host') {
                        $databaseHost = $explode[1];
                    }
                    if ($explode[0] == 'database') {
                        $databaseName = $explode[1];
                    }
                    if ($explode[0] == 'user_name') {
                        $databaseUserName = $explode[1];
                    }
                    if ($explode[0] == 'password') {
                        $databasePassword = $explode[1];
                    }
                }

                fclose($readFile);

            }

            static::$databaseConf = [
                "host" => trim($databaseHost),
                "database" => trim($databaseName),
                "user" => trim($databaseUserName),
                "password" => trim($databasePassword),
            ];
        }
        return static::$databaseConf;
    }

    public static function createEnvFile($data)
    {
        $fp = fopen(ConstantManager::$appRoot."/config/db.env", 'w') or die('Sorry! permission problem');
        fwrite($fp, $data);
        fclose($fp);
        return true;
    }

}
