<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//index
Route::get('/', ['as' => 'index','uses' => 'IndexController@index']);

//token
Route::get('token', ['as' => 'token','uses' => 'IndexController@token']);

Route::group(['middleware' => ['auth:web']], function () {
    Route::any('userinfo', ['as' => 'userinfo','uses' => 'IndexController@userinfo']);
    Route::any('logout', ['as' => 'logout','uses' => 'IndexController@logout']);
});
