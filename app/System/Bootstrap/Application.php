<?php


namespace App\System\Bootstrap;


use App\System\helper\ConstantManager;
use App\System\Route\RouteManager;

class Application
{

    public static function boot()
    {

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        session_start();

        require_once ConstantManager::$appRoot.'/app/System/helper/globalFunction.php';

        $routeManager = new RouteManager();
        $routeManager->init();
    }


}
