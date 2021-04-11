<?php


namespace App\Controller;


use App\Models\Contact;
use App\models\DBQuery;
use App\System\DB;
use App\System\Helper\EnvManager;
use App\System\Request;
use App\utilities\DynamicDBConfig;

class DatabaseSetupController
{


    public function __invoke()
    {

        return view('databaseSetup');
    }

    public function save(Request $request)
    {
   //     return responseJson($request->all());

        if (!$request->database_name  || !$request->user_name  || !$request->password) {
            return responseJson('Please check required Fields', 422);
        }

        $configData = 'host=' . ($request->database_host ? $request->database_host : 'localhost' ) . PHP_EOL;
        $configData .= 'database=' . $request->database_name . PHP_EOL;
        $configData .= 'user_name=' . $request->user_name . PHP_EOL;
        $configData .= 'password=' . $request->password . PHP_EOL;

        // generate env file
        EnvManager::createEnvFile($configData);
        sessionFlash("message", "Database configuration saved successfully");

        $this->migration();
        return redirect('/');
    }


    public function migration()
    {
        $db = new DB();
        $sql = "CREATE TABLE IF NOT EXISTS  `contacts` (
                  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                  `amount` int(10) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `buyer` varchar(255) COLLATE utf8mb4_unicode_ci  NOT NULL,
                  `receipt_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `items` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `buyer_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `buyer_ip` varchar(20) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
                  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `city` varchar(20) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
                  `phone` varchar(20) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
                  `hash_key` varchar(255) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
                  `entry_at` date  DEFAULT NULL,
                  `entry_by` int(10)  NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        return $db->run($sql);

    }

}
