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
        $goodid = $this->category->article()->first()->id ?? 0;
        $goodinfo = new \App\Packages\Article\Resources\Article(Article::find($goodid));
        return [
            'id' => $this->id,
            'pay_type'  => $this->pay_type,
            'user_id'   => $this->user_id,
            'serial'    => $this->serial,
            'good_id'   => $goodid,
            'cate_id'   => $this->cate_id,
            'cate_name'   => $this->cate_name,
            'cate_zip'   => $this->category->zip_url ?? '',
            'good_info'   => $goodinfo,
            'good_name' => $goodinfo['title'],
            'price' => round($this->price/100,2),
            'is_fenqi' => $this->is_fenqi ?? 0,
            'old_price' => round($this->old_price/100,2),
            'payed_at'  => $this->payed_at,
            'created_at'  => (string)$this->created_at,
        ];
    }
}
