<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SendMailProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('sendmail', function(){
           return new \App\Classes\SendMail;
        });
    }
}
