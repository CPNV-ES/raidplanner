<?php

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class Role extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'role';
    }
}