<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 14:45
 */

namespace App\Packages\Category;

use App\Packages\Category\Interfaces\CategoryInterface;
use App\Packages\Category\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/databases/migrations/create_category_tables.php.stub' => $this->app->databasePath()."/migrations/".date('Y_m_d_His')."_create_category_tables.php",
        ], 'migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryInterface::class,CategoryRepository::class);
    }
}