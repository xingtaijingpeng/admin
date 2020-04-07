<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/4
 * Time: 14:19
 */

namespace App\Packages\UEditor\Facades;


use App\Packages\UEditor\Interfaces\UEditorInterface;

class UEditor
{
    protected static function getFacadeAccessor()
    {
        return UEditorInterface::class;
    }

    public static function route()
    {
        app()->make('router')->group([
            'prefix' => 'ueditor',
            'as' => 'ueditor.',
        ],function ($route){
            $route->any('gate',['as' => 'gate','uses' => '\App\Packages\UEditor\Controller\UEditorController@gate']);
        });
    }
}
