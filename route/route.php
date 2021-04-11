<?php

$router->get('/', 'HomeController@home');

 $router->post('/database-setup', 'DatabaseSetupController@save');

$router->get('/database-setup', 'DatabaseSetupController');

 $router->get('/submit-form', 'ContactFormController@form');
 $router->post('/submit-form', 'ContactFormController@saveData');


 $router->get('/test', function()   {
  return responseJson([
        'name' =>  (new Contact())->get(),
        "config" => config('data.name')
    ],200 );

 });

