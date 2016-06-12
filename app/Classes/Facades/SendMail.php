<?php

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class SendMail extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'sendmail';
    }
}