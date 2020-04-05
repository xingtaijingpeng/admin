<?php

namespace App\Providers;

use App\Packages\Article\ArticleServiceProvider;
use App\Packages\Filer\UploadServiceProvider;
use App\Packages\UEditor\UEditorServiceProvider;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UploadServiceProvider::class);
        $this->app->register(UEditorServiceProvider::class);
        $this->app->register(ArticleServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
