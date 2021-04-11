<?php


namespace App\System\Bootstrap;


use App\System\Database\DatabaseManager;
use App\System\Database\Driver\MySQL;
use App\System\helper\ConstantManager;

class Application
{

    public static function boot(){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        session_start();

        require_once ConstantManager::$appRoot . '/app/System/helper/globalFunction.php';

        $routeManager = new \App\System\Route\RouteManager();
        $routeManager->init();
    }


}
