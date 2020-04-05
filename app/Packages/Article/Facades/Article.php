<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:39
 */

namespace App\Packages\Article\Facades;

use App\Packages\Article\Contracts\ArticleContract;
use Illuminate\Support\Facades\Facade;

class Article extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ArticleContract::class;
    }

    public static function route($auth = false)
    {
        app()->make('router')->group([
            'prefix' => 'article'
        ],function ($route)use($auth){
            if($auth){
                $route->any('create','\App\Packages\Article\Controllers\ArticleController@create');
            }else{
                $route->any('index','\App\Packages\Article\Controllers\ArticleController@index');
            }
        });
    }
}
