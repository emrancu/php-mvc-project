<?php

namespace App\System\Route;


use App\System\helper\ConstantManager;

class RouteManager
{


    function init()
    {
        $router = new RouteResolver();
        require_once ConstantManager::$appRoot . '/route/route.php';
    }



}
