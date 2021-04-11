<?php

namespace App\System\Route;

use App\System\DependencyContainer;

class RouteResolver
{

    public $routes = [];
    private $request;
    private $requestMethod;
    private $supportedMethods = array(
        "GET",
        "POST"
    );

    /**
     * Router constructor.
     */
    function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }


    /**
     * @param $methodName
     * @param $arguments
     */
    function __call($methodName, $arguments)
    {
        // make list from argument and closer function
        list($route, $method) = $arguments;
        array_push($this->routes, $route);

        // check method name exist in supported methods array
        if (!in_array(strtoupper($methodName), $this->supportedMethods)) {
            //   $this->invalidMethodHandler();
        }
        $this->{strtolower($methodName)}[$this->formatRoute($route)] = $method;

    }

    /**
     * @param $route
     * @return string
     */
    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    function __destruct()
    {
        $this->routeChecking();
    }

    function routeChecking()
    {
        $methodDictionary = $this->{strtolower($this->requestMethod)} ?? '';
        $formattedRoute = $this->formatRoute($this->currentRoute());

        if (!isset($methodDictionary[$formattedRoute])) {
            if (isset($this->{'get'}[$formattedRoute]) || isset($this->{'post'}[$formattedRoute])) {
                $this->invalidMethodHandler();
            } else {
                $this->notFound();
            }
        }


        $method = isset($methodDictionary[$formattedRoute]) ? $methodDictionary[$formattedRoute] : null;
        if (is_null($method)) {
            return $this->invalidMethodHandler();
        }

        if (gettype($method) == 'object') {
            return call_user_func($method);
        } else {

            return DependencyContainer::instance()->call($method);
        }

    }

    public function currentRoute()
    {

        $base = $_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
        $full = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

        return substr($full, strlen($base));
    }

    /**
     *if method is not valid
     */
    private function invalidMethodHandler()
    {
        echo "Method Not Allowed";
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
        exit;

    }

    private function notFound()
    {
        echo "404 - No Route Found";
        header("{$this->request->serverProtocol} 404 Not Found");
        exit;
    }


}
