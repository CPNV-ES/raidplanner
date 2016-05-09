<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('validate/{id}/{remember_token}', 'UsersController@validateRegisterToken');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('login', 'SessionsController@create');
    Route::post('login', 'SessionsController@store');
    Route::get('logout', 'SessionsController@destroy');

    Route::get('register', 'UsersController@create');
    Route::post('register', 'UsersController@store');

    Route::group(['middleware' => ['auth']], function (){

        Route::get('home', function () {
            return view('home');
        });

        Route::group(['middleware' => [/*'subdomain.resource', */'role']], function(){
            Route::resource('alliances', 'TempController');

            Route::resource('guilds', 'TempController');

            Route::resource('groups', 'TempController');
        });

        Route::group(['prefix' => 'users/{user}'], function() {
            Route::get('/', 'ProfileController@show');
            Route::get('/profile', 'ProfileController@show');
        });

        Route::group(['prefix' => 'profile', 'middleware' => 'role'], function() {
            Route::get('', 'UsersController@show');
            Route::get('edit', 'UsersController@edit');
            Route::put('edit', ['before' => 'csrf', 'uses' => 'UsersController@update']);
        });


    });
});
