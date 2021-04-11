<?php


namespace App\Controller;


use App\Models\Contact;
use App\System\Helper\EnvManager;
use App\System\Middleware\DatabaseSetup;
use App\System\Request;

class HomeController
{

    public function __construct(DatabaseSetup $databaseSetup)
    {
        $databaseSetup->handle();
    }

    public function home()
    { 
        $contacts = new Contact();

        return view('index', [
            "contacts" => $contacts->get()
        ]);
    }


}
