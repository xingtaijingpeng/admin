<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/16
 * Time: 17:41
 */

namespace App\Packages\Order\Repositories;


use App\Packages\Order\Interfaces\OrderInterface;
use App\Packages\Order\Models\OrdOrder;

class OrderRepository implements OrderInterface
{

	/**
	 * 订单分页通过where
	 * @param $pageSize
	 * @return mixed
	 */
	public function paginate($pageSize)
	{
		return OrdOrder::where(\Arr::except(request('data'),['']))->orderBy('id','DESC')->paginate($pageSize);
	}
}
