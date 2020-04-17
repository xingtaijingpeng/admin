<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/16
 * Time: 17:40
 */

namespace App\Packages\Order\Interfaces;


interface OrderInterface
{
	/**
	 * 订单分页通过where
	 * @param $pageSize
	 * @return mixed
	 */
	public function paginate($pageSize);
}
