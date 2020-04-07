<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:39
 */

namespace App\Packages\Article\Facades;

use App\Packages\Article\Interfaces\ArticleInterface;
use Illuminate\Support\Facades\Facade;

class Article extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ArticleInterface::class;
    }

    public static function route($auth = false)
    {
        app()->make('router')->group([
            'prefix' => 'article',
            'as' => 'article.'
        ],function ($route)use($auth){
            if($auth){
                $route->any('detail/{id}',  ['as' => 'detail','uses' => '\App\Packages\Article\Controllers\ArticleController@detail']);
                $route->any('create',       ['as' => 'create','uses' => '\App\Packages\Article\Controllers\ArticleController@create']);
                $route->any('update/{id}',  ['as' => 'update','uses' => '\App\Packages\Article\Controllers\ArticleController@update']);
                $route->any('delete/{id}',  ['as' => 'delete','uses' => '\App\Packages\Article\Controllers\ArticleController@delete']);
            }else{
                $route->any('index',        ['as' => 'index', 'uses' => '\App\Packages\Article\Controllers\ArticleController@index']);
            }
        });
    }
}
