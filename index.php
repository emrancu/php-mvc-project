<?php

use App\System\Bootstrap\Application;
use App\System\helper\ConstantManager;

require_once __DIR__.'/vendor/autoload.php';

ConstantManager::setPath(__DIR__);

Application::boot();
