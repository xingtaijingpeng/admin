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
Route::get('/', ['as' => 'index','uses' => 'IndexController@index']);

//邮件实例
Route::get('mail', ['as' => 'mail','uses' => 'IndexController@mail']);

//token
Route::post('token', ['as' => 'token','uses' => 'LoginController@token']);
Route::post('refresh', ['as' => 'refresh','uses' => 'LoginController@refresh']);
UEditor::route();

Route::group(['middleware' => ['auth:admin']], function () {
    Upload::route();
    Route::post('logout', ['as' => 'logout','uses' => 'LoginController@logout']);
    Route::post('userinfo', ['as' => 'userinfo','uses' => 'IndexController@userinfo']);

    Route::group(['prefix' => 'system', 'as' => 'system.', 'namespace' => 'System'], function () {
        Route::group(['prefix' => 'develop', 'as' => 'develop.', 'namespace' => 'Develop'], function () {

            Route::any('permission', ['as' => 'permission','uses' => 'PermissionController@index']);
            Route::post('permission/create', ['as' => 'permission.create','uses' => 'PermissionController@create']);
            Route::post('permission/detail/{model}', ['as' => 'permission.detail','uses' => 'PermissionController@detail']);
            Route::post('permission/update/{model}', ['as' => 'permission.update','uses' => 'PermissionController@update']);
            Route::post('permission/delete/{model}', ['as' => 'permission.delete','uses' => 'PermissionController@delete']);

            Route::post('role', ['as' => 'role','uses' => 'RoleController@index']);
            Route::post('role/create', ['as' => 'role.create','uses' => 'RoleController@create']);
            Route::post('role/detail/{model}', ['as' => 'role.detail','uses' => 'RoleController@detail']);
            Route::post('role/update/{model}', ['as' => 'role.update','uses' => 'RoleController@update']);
            Route::post('role/delete/{model}', ['as' => 'role.delete','uses' => 'RoleController@delete']);

        });
    });
});
