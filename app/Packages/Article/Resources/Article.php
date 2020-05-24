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
            'teacher_id' => $this->teacher_id,
			'category' => $this->categories()->first()->name ?? '',
			'title' => $this->title,
			'zhangjie' => $this->zhangjie,
            'cover' => $this->cover,
            'sorts' => $this->sorts,
            'description' => $this->description,
            'url' => $this->url,
            'price' => round($this->price/100,2),
            'old_price' => round($this->old_price/100,2),
            'opened_at' => (string)$this->opened_at,
            'created_at' => (string)$this->created_at,
            'content' => $this->content->content ?? '',
            'teacher' => \App\Packages\Article\Models\Article::find($this->teacher_id),
        ];
    }
}
