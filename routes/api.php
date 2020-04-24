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
Article::route();
Category::route();
Route::post('sms', ['as' => 'sms','uses' => 'IndexController@sms']);

//token
Route::post('token', ['as' => 'token','uses' => 'IndexController@token']);
Route::post('register', ['as' => 'register','uses' => 'IndexController@register']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::any('userinfo', ['as' => 'userinfo','uses' => 'IndexController@userinfo']);
});
