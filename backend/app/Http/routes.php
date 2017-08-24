<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'user'], function()
{
    Route::post('/login', 'LoginController@login');
    Route::group(['middleware' => ['jwt.auth']], function()
    {
        Route::delete('/logout', 'LoginController@logout');
        Route::post('/create', 'LoginController@create_user');
        Route::put('/update/password/{uid}', 'LoginController@update_password');
    });
});
