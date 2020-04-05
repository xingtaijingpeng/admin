<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::options('/{all}', function() {
            return \Response::make('', 200, ['Access-Control-Allow-Headers'=> '*']);
        })->where(['all' => '.+']);

        $this->mapWebRoutes();

        $this->mapApiRoutes();

        $this->mapAdminRoutes();

        $this->mapTenantRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::domain(config('app.url'))
            ->middleware('web')
            ->namespace($this->namespace . '\\Web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::domain(config('app.api_url'))
            ->middleware('api')
            ->namespace($this->namespace . '\\Api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::domain(config('app.admin_url'))
            ->middleware('api')
            ->namespace($this->namespace . '\\Admin')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapTenantRoutes()
    {
        Route::domain(config('app.tenant_url'))
            ->middleware('api')
            ->namespace($this->namespace . '\\Tenant')
            ->group(base_path('routes/tenant.php'));
    }
}
