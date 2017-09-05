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
Route::get('/template/{uid}', 'TemplateController@index');

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', 'LoginController@login');
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/', 'UserController@index');
        Route::get('/{uid}', 'UserController@show');
        Route::post('/', 'UserController@create_user');
        Route::patch('/expired/{uid}', 'UserController@update_expired');
        Route::patch('/password/{uid}', 'UserController@update_password');
        Route::delete('/{uid}', 'UserController@destroy');
        Route::delete('/logout', 'LoginController@logout');
    });
});

Route::group(['prefix' => 'config'], function () {
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/', 'ConfigController@index');
        Route::put('/', 'ConfigController@update');
    });
});

Route::group(['prefix' => 'ad'], function () {
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/', 'AdController@index');
        Route::post('/', 'AdController@add');
        Route::put('/{id}', 'AdController@update');
        Route::delete('/{id}', 'AdController@destroy');
    });
});
