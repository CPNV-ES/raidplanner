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

    /* Route for public site */
    Route::group(['domain' => 'raidplanner.dev'], function(){
        Route::get('/', 'PublicController@welcome')->name('public.welcome');

        Route::group(['middleware' => ['auth']], function () {
            Route::get('server_list', 'PublicController@server_list')->name('public.server_list');
        });

        /* Validation of user */
        Route::get('validate/{id}/{remember_token}', 'UsersController@validateRegisterToken');
    });

    /* Login / Logout route */
    Route::get('login', 'SessionsController@create')->name("login");
    Route::post('login', 'SessionsController@store');
    Route::get('logout', 'SessionsController@destroy')->name("logout");;

    /* Register route */
    Route::get('register', 'UsersController@create')->name("register");;
    Route::post('register', 'UsersController@store');

    Route::group(['domain' => '{subdomain}.raidplanner.dev', 'middleware' => ['auth']], function (){

        /* base route for app site */
        Route::get('/', 'HomeController@welcome')->name('app.welcome');

        Route::get('/news', 'HomeController@news')->name('app.news');

        Route::group(['middleware' => ['subdomain.resource']], function(){
            /* Short link */
            Route::get('my/alliance', 'AlliancesController@showMy')->name('show.my.alliance');
            Route::get('my/guild', 'GuildsController@showMy')->name('show.my.guild');
            Route::get('my/group', 'TempController@showMy')->name('show.my.group');

            Route::group(['middleware' => ['role']], function() {
                /* Alliance route */
                Route::get('alliances/{alliances}/members/edit', 'TempController@editMembers')->name('alliances.members.edit');
                Route::put('alliances/{alliances}/members/{guilds}', 'TempController@actionMembers')->name('alliances.members.update');
                Route::put('alliances/{alliances}/quit', 'TempController@quit')->name('guilds.alliances.quit');
                Route::resource('alliances', 'AlliancesController');

                /* Guild Route */
                Route::get('guilds/{guilds}/members/edit', 'TempController@editMembers')->name('guilds.members.edit');
                Route::put('guilds/{guilds}/members/{users}', 'TempController@actionMember')->name('guilds.members.update');
                Route::put('guilds/{guilds}/quit', 'GuildsController@quit')->name('guilds.quit');
                Route::resource('guilds', 'GuildsController');

                /* Group Route */
                Route::get('groups/{groups}/members/edit', 'TempController@editMembers')->name('groups.members.edit');
                Route::put('groups/{groups}/members/{members}', 'TempController@actionMember')->name('groups.members.update');
                Route::resource('groups', 'TempController');
            });
        });

        /* Show all user having a guild on server */
        Route::get('users', 'ProfilesController@index')->name('users.profiles.index');
        /* Route for showing profile of users */
        Route::group(['prefix' => 'users/{user}'], function() {
            Route::get('/', 'ProfilesController@show');
            Route::get('/profile', 'ProfilesController@show')->name('user.profiles.show');
        });

        /* Show and edit the personal profile */
        Route::group(['prefix' => 'profile'], function() {
            Route::get('', 'UsersController@show')->name('profile.show');
            Route::get('edit', 'UsersController@edit')->name('profile.edit');
            Route::put('edit', ['before' => 'csrf', 'uses' => 'UsersController@update']);
        });
    });
});
