<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:22
 */

namespace App\Packages\Article;

use App\Packages\Article\Contracts\ArticleContract;
use App\Packages\Article\Interfaces\ArticleInterface;
use App\Packages\Article\Repositories\ArticleRepository;
use App\Packages\Article\Services\ArticleService;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/databases/migrations/create_article_tables.php.stub' => $this->app->databasePath()."/migrations/".date('Y_m_d_His')."_create_article_tables.php",
        ], 'migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleInterface::class,ArticleRepository::class);
    }
}
