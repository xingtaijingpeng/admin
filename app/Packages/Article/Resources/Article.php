<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/6
 * Time: 15:40
 */

namespace App\Packages\Article\Resources;


use App\Resources\Base;

class Article extends Base
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'cover' => $this->cover,
            'category' => $this->categories()->first()->name ?? '',
            'content' => $this->content->content ?? '',
        ];
    }
}
