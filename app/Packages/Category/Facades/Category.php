<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 15:25
 */

namespace App\Packages\Category\Facades;

use App\Packages\Category\Interfaces\CategoryInterface;
use Illuminate\Support\Facades\Facade;

class Category extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CategoryInterface::class;
    }

    public static function route($auth = false)
    {
        app()->make('router')->group([
            'prefix' => 'category'
        ],function ($route)use($auth){
            if($auth){
                $route->any('detail/{id}','\App\Packages\Category\Controllers\CategoryController@detail');
                $route->any('create','\App\Packages\Category\Controllers\CategoryController@create');
                $route->any('update/{id}','\App\Packages\Category\Controllers\CategoryController@update');
                $route->any('delete/{id}','\App\Packages\Category\Controllers\CategoryController@delete');
            }else{
                $route->any('index','\App\Packages\Category\Controllers\CategoryController@index');
            }
        });
    }
}