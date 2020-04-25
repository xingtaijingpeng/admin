<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/25
 * Time: 12:16
 */

namespace App\Resources\Api;

use App\Packages\Article\Models\Article;
use App\Resources\Base;

class OrdOrder extends Base
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pay_type'  => $this->pay_type,
            'user_id'   => $this->user_id,
            'serial'    => $this->serial,
            'good_id'   => $this->good_id,
            'good_info'   => new \App\Packages\Article\Resources\Article(Article::find($this->good_id)),
            'good_name' => $this->good_name,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'payed_at'  => $this->payed_at,
            'created_at'  => (string)$this->created_at,
        ];
    }
}
