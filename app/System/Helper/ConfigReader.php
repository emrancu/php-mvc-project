<?php


namespace App\System\Helper;


class ConfigReader
{
    private static $instance = null;
    public $config;

    public function __construct()
    {
        $this->config = include ConstantManager::$appRoot.'/Config/app.php';
    }


    public static function init()
    {
        if (self::$instance == null) {
            self::$instance = new ConfigReader();
        }

        return self::$instance;
    }


    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $data = explode('.', $key);
        $finalData = $this->config;
        foreach ($data as $k => $v) {
            $finalData = $finalData[$v];
        }
        return $finalData;
    }

}
