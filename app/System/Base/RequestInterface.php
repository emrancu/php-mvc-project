<?php

namespace App\System\Base;

interface RequestInterface
{


    /**
     *
     * set all requested data as this class property;
     */
    public function serverDataSet();


    /**
     *set server global data as this class property
     */
    public function postDataSet();


    /**
     *set server global data as this class property
     */
    public function getDataSet();


    /**
     * make camel case
     * @param $string
     * @return mixed|string
     */
    public function makeCamelCase($string);


    /**
     *  get data from request
     * @param $name
     * @return string
     */
    public function get($name);


}
