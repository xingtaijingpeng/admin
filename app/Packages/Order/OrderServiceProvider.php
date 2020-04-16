<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/16
 * Time: 17:39
 */

namespace App\Packages\Order;

use App\Packages\Order\Interfaces\OrderInterface;
use App\Packages\Order\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/databases/migrations/create_ord_order_tables.php.stub' => $this->app->databasePath()."/migrations/".date('Y_m_d_His')."_create_ord_order_tables.php",
		], 'migrations');
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(OrderInterface::class,OrderRepository::class);
	}
}
