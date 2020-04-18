<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//index
Route::any('/index', ['as' => 'index','uses' => 'IndexController@index']);
Route::any('/base', ['as' => 'base','uses' => 'IndexController@base']);

//token
Route::get('token', ['as' => 'token','uses' => 'IndexController@token']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::any('userinfo', ['as' => 'userinfo','uses' => 'IndexController@userinfo']);
});
