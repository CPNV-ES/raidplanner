<?php

namespace App\Classes;

use Mockery\CountValidator\Exception;

class RouteParser{

    private $routePatern = '/^([a-z]+)\.([a-z]+(\.[a-z]+)*)$/';
    private $nestedPatern = '/^([a-z]+)\.([a-z]+)$/';

    public function parse($route){
        preg_match($this->routePatern, $route, $matches);

        return $matches;
    }

    public function isNestedResource($subRoute){
        preg_match($this->nestedPatern, $subRoute, $matches);

        if(empty($matches)){
            return false;
        }

        return true;
    }

    public function getNestedResource($subRoute){
        preg_match($this->nestedPatern, $subRoute, $matches);

        return $matches;
    }
}