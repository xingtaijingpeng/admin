<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/6
 * Time: 15:40
 */

namespace App\Packages\Article\Resources;


use App\Resources\Base;
use App\Resources\User;

class Article extends Base
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'hot' => $this->hot,
            'user' => new User($this->user),
            'category_id' => $this->categories()->first()->id,
			'category' => $this->categories()->first()->name ?? '',
			'title' => $this->title,
            'cover' => $this->cover,
            'sorts' => $this->sorts,
            'description' => $this->description,
            'url' => $this->url,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'opened_at' => (string)$this->opened_at,
            'created_at' => (string)$this->created_at,
            'content' => $this->content->content ?? '',
        ];
    }
}
