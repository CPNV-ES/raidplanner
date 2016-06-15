<?php

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class RouteParser extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'routeparser';
    }
}