<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/4
 * Time: 14:21
 */

namespace App\Packages\UEditor;

use Illuminate\Support\ServiceProvider;
use App\Packages\UEditor\Interfaces\UEditorInterface;
use App\Packages\UEditor\Repositories\UEditorRepository;

class UEditorServiceProvider extends ServiceProvider
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
        $this->app->bind(UEditorInterface::class,UEditorRepository::class);
    }
}
