<?php


namespace App\System\Middleware;


use App\System\Helper\EnvManager;

class DatabaseSetup
{

    public function handle()
    {
        if (!EnvManager::checkEnv()) {
            return redirect('/database-setup');
        }
    }

}
