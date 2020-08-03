<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/17
 * Time: 16:42
 */

namespace App\Resources\Admin;

use App\Resources\Base;

class Order extends Base
{
	public function toArray($request)
	{
		return [
			'id' 		=> $this->id,
			'status'	=> $this->status,
			'pay_type'	=> $this->pay_type == 1 ? '微信' : '支付宝',
			'user'	=> $this->user,
			'serial'	=> $this->serial,
			'good_id'	=> $this->good_id,
			'good_name'	=> $this->good_name,
			'price'		=> round($this->price/100,2),
			'nprice'		=> round($this->nprice/100,2),
			'old_price'	=> round($this->old_price/100,2),
			'payed_at'	=> (string)$this->payed_at,
			'created_at'=> (string)$this->created_at,
		];
	}
}
