<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/31
 * Time: 18:35
 */

namespace App\Packages\Filer;

use App\Packages\Filer\Interfaces\UploadInterface;
use App\Packages\Filer\Repositories\UploadRepository;
use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadInterface::class,UploadRepository::class);
    }
}