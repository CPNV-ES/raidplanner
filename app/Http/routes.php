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

Route::get('validate/{id}/{remember_token}', 'UserController@validateRegisterToken');

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
    Route::get('login', 'SessionController@create');
    Route::post('login', 'SessionController@store');
    Route::get('logout', 'SessionController@destroy');

    Route::get('register', 'UserController@create');
    Route::post('register', 'UserController@store');

    Route::group(['middleware' => ['auth']], function (){

        Route::get('home', function () {
            return view('home');
        });

        Route::get('profile', 'UserController@showLogged');
        Route::get('profile/{id}', 'UserController@show')->where('id', '[0-9]+');;
        Route::get('profile/edit', 'UserController@editLogged');
        Route::get('profile/edit/{id}', 'UserController@edit')->where('id', '[0-9]+');;
        Route::put('profile/edit/{id}',['before' => 'csrf','uses' => 'UserController@update'])->where('id', '[0-9]+');;
    });
});
