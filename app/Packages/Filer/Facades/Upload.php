<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/31
 * Time: 18:34
 */

namespace App\Packages\Filer\Facades;

use App\Packages\Filer\Interfaces\UploadInterface;
use Illuminate\Support\Facades\Facade;

class Upload extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UploadInterface::class;
    }

    public static function route()
    {
        app()->make('router')->group([
            'prefix' => 'upload',
            'as' => 'upload.'
        ],function ($route){
            $route->any('image',['as' => 'image','uses' => '\App\Packages\Filer\Controller\UploadController@image']);
            $route->any('excel',['as' => 'excel','uses' => '\App\Packages\Filer\Controller\UploadController@excel']);
            $route->any('remove',['as' => 'remove','uses' => '\App\Packages\Filer\Controller\UploadController@remove']);
        });
    }
}
