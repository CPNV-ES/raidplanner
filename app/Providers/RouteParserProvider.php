<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteParserProvider extends ServiceProvider
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
        $this->app->bind('routeparser', function(){
           return new \App\Classes\RouteParser;
        });
    }
}
