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
Route::any('/', function (){
    header("Location: /index.html");
});
Route::any('/index', ['as' => 'index','uses' => 'IndexController@index']);
Route::any('/base', ['as' => 'base','uses' => 'IndexController@base']);
Article::route();
Category::route();
Route::post('sms', ['as' => 'sms','uses' => 'IndexController@sms']);
Route::any('notify', ['as' => 'notify','uses' => 'IndexController@notify']);
Route::any('backurl', ['as' => 'backurl','uses' => 'IndexController@backurl']);

//token
Route::post('token', ['as' => 'token','uses' => 'IndexController@token']);
Route::post('register', ['as' => 'register','uses' => 'IndexController@register']);
Route::post('forget', ['as' => 'register','uses' => 'IndexController@forget']);
Route::any('comment/{id}', ['as' => 'comment','uses' => 'IndexController@comment']);

Route::group(['middleware' => ['auth:api']], function () {
    Upload::route();
    Route::any('userinfo', ['as' => 'userinfo','uses' => 'IndexController@userinfo']);
    Route::any('hasbuy/{id}', ['as' => 'userinfo','uses' => 'IndexController@hasbuy']);
    Route::any('change/cover', ['as' => 'change/cover','uses' => 'IndexController@changeCover']);
    Route::any('change/password', ['as' => 'change/cover','uses' => 'IndexController@changePassword']);

    Route::any('user/goods', ['as' => 'change/cover','uses' => 'OrderController@goods']);
    Route::any('user/message', ['as' => 'change/cover','uses' => 'OrderController@message']);
	Route::any('order/make', ['as' => 'order.make','uses' => 'OrderController@mkorder']);
	Route::any('order/repay', ['as' => 'order.repay','uses' => 'OrderController@repayorder']);
	Route::any('order/check', ['as' => 'order.check','uses' => 'OrderController@ordercheck']);
	Route::any('order/delete', ['as' => 'order.delete','uses' => 'OrderController@orderdelete']);
});
