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

    Route::group(['domain' => 'raidplanner.dev'], function(){
        Route::get('/', function () {
            return view('public.welcome');
        })->name('public.welcome');

        Route::group(['middleware' => ['auth']], function () {
            Route::get('home', function () {
                return view('public.home');
            })->name('public.home');
        });

        Route::get('validate/{id}/{remember_token}', 'UsersController@validateRegisterToken');
    });

    /* Login / Logout route */
    Route::get('login', 'SessionsController@create');
    Route::post('login', 'SessionsController@store');
    Route::get('logout', 'SessionsController@destroy');

    /* Register route */
    Route::get('register', 'UsersController@create');
    Route::post('register', 'UsersController@store');

    Route::group(['domain' => '{subdomain}.raidplanner.dev', 'middleware' => ['auth']], function (){

        Route::get('/', 'HomeController@welcome')->name('app.welcome');

        Route::get('/home', 'HomeController@home')->name('app.home');

        Route::group(['middleware' => ['subdomain.resource']], function(){
            /* Short link */
            Route::get('my/alliance', 'TempController@showMy')->name('show.my.alliance');
            Route::get('my/guild', 'TempController@showMy')->name('show.my.guild');
            Route::get('my/group', 'TempController@showMy')->name('show.my.group');

            Route::group(['middleware' => ['role']], function() {
                /* Alliance route */
                Route::get('alliances/{alliances}/edit_members', 'TempController@editMembers')->name('alliances.edit_members');
                Route::put('alliances/{alliances}/member/{member}', 'TempController@actionMember')->name('alliances.action_member');
                Route::resource('alliances', 'AlliancesController');

                /* Guild Route */
                Route::get('guilds/{guilds}/edit_members', 'TempController@editMembers')->name('guilds.edit_members');
                Route::put('guilds/{guilds}/member/{member}', 'TempController@actionMember')->name('guilds.action_member');
                Route::resource('guilds', 'GuildsController');

                /* Group Route */
                Route::get('groups/{groups}/edit_members', 'TempController@editMembers')->name('groups.edit_members');
                Route::put('groups/{groups}/member/{member}', 'TempController@actionMember')->name('groups.action_member');
                Route::resource('groups', 'TempController');
            });
        });

        /* Route for showing profile of users */
        Route::group(['prefix' => 'users/{user}'], function() {
            Route::get('/', 'ProfileController@show');
            Route::get('/profile', 'ProfileController@show')->name('user.profile.show');
        });

        /* Show and edit the personal profile */
        Route::group(['prefix' => 'profile'], function() {
            Route::get('', 'UsersController@show')->name('profile.show');
            Route::get('edit', 'UsersController@edit')->name('profile.edit');
            Route::put('edit', ['before' => 'csrf', 'uses' => 'UsersController@update']);
        });


    });
});
