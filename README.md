# Installation or testing process

<ul>
 <li> Pull project to your server with git or download 
  <pre>
  git clone https://github.com/emrancu/php-mvc-project.git
  </pre>
  </li>
<li>
 Create a Database 
</li>
 <li> Open Project in browser and submit your database name, user & password in a form</li>
 <li> Then Done </li>
 
</ul>


# Project Highlight

<ul> 
<li>PSR-4 
 <pre>
  "psr-4": {
      "App\\": "app/", 
    }
 </pre>
 </li>
<li> Simple Routing System
    <pre>
    $router->get('/', function($request) {
        $controller =  new HomeController($request) ;
       return $controller->home();
    });
    
    $router->get('/', 'HomeController@home'); 
    
    $router->get('/database-setup', 'DatabaseSetupController');
    
 </pre>
</li>
<li>
 Dependency Injection Container </li>
  
  <pre>
  namespace -  App\System\Base\Container;
  
  DependencyContainer::instance()->call("HomeController@index");
  DependencyContainer::instance()->call("HomeController", $parameters); // call __invoke method
  DependencyContainer::instance()->make(HomeController::class, $parameters); // get instance
  
  </pre>

<li> Singleton Pattern </li>
<li> Dependency Inversion for Database Connection </li>
<li> MVC </li>
<li> Database Configuration setup from Form Input and create db.env file
 <pre>
        EnvManager::createEnvFile($configData); // create db.env file in /config dir
        EnvManager::get('host') // get config
  </pre>
  </li>
<li> Helper Function for redirect , json response, view
  <pre>
   responseJson("Something went wrong", 422);
   redirect('/home');
   sessionFlash('message', 'Successfully inserted');
   view('person.create', compact('types')
   view('person.create',["types" => $types])
   config('author.name') // get config data from /config/app.php
   url('home') // generate route url  
 </pre>
 </li>
<li> Data Compact from controller and extract from view and access from View File 
    <pre>
   $purchase = new Purchase();
   $purchaseData = $purchase->getAll();
   return view('index', compact('purchaseData'));
   or
   return view('index', ['purchaseData' => $purchaseData]);
         
 </pre>
</li>
<li> Flush Session for one-time (reset after page loaded)
    <pre>
// unset flush session
function unsetFlashSession()
{
    foreach ($_SESSION as $key => $value) {
        if (strpos($key, 'app_flash_') === 0) {
            unset ($_SESSION[$key]);
        }
    }
}

    // set or get session
    function sessionFlash($name, $message = '')
    {
        if ($message) {
            $_SESSION["app_flash_" . $name] = $message;
        } else {
            return $_SESSION["app_flash_" . $name] ?? '';
        }
    }
</pre>
</li>

<li>
 Data Validation System  with PHP 
  <pre>
       $check = Validator::execute($this->request, [
            'amount' => 'required|number',
            'buyer' => 'required|noSpecialChar|limit:20,50',
            'receipt_id' => 'required|letter',
            'buyer_email' => 'required|email',
            'note' => 'required|wordLimit:2,30',
            'city' => 'required|letter',
            'phone' => 'required|mobile',
            'entry_by' => 'required|number'
        ]);
        
       if (!$check['status']) {
           return json($check, 419);
       }
  </pre>  
</li>

<li>
Input Field Data Validation System with JS :
 <p>Self Developed: <a href="https://github.com/emrancu/FieldValidator"> Field Validator </a></p>
</li>
<li>
WebToast/ alert system:
 <p>Self Developed: <a href="https://github.com/emrancu/webtoast"> webToast </a></p>
</li>
<li> JS Fetch for Ajax Request</li>
</ul>
 
 
 
# License
<p>The MIT License (MIT)</p>

Developed with ❤ by <a href="https://alemran.me">AL EMRAN</a>
