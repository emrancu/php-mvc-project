<?php

namespace App\System;

use App\System\Base\RequestInterface;

class Request implements RequestInterface
{

    private $requestMethod;
    private $data = [];

    function __construct()
    {
        $this->requestInit();
    }

    /**
     *
     * set all requested data as this class property;
     */
    public function requestInit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->requestMethod = 'POST';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->requestMethod = 'GET';
        }

        $this->serverDataSet();
        $this->postDataSet();
        $this->getDataSet();
    }


    /**
     *set server global data as this class property
     */
    public function serverDataSet()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->makeCamelCase($key)} = $value;
        }
    }

    /**
     * make camel case
     * @param $string
     * @return mixed|string
     */
    public function makeCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    /**
     *set server global data as this class property
     */
    public function postDataSet()
    {
        foreach ($_POST as $key => $value) {
            $this->{$key} = $value;
            $this->data[$key] = $value;
        }

    }

    /**
     *set server global data as this class property
     */
    public function getDataSet()
    {
        foreach ($_GET as $key => $value) {
            $this->{$key} = $value;
            $this->data[$key] = $value;
        }

    }


    public function all()
    {
        return $this->data;
    }

    public function get($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }


    public function __get($property)
    {
        return isset($this->{$property}) ? $this->{$property} : null;
    }


}
