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

class Message extends Base
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title'  => $this->title,
            'content'   => $this->content,
            'created_at'  => (string)$this->created_at,
        ];
    }
}
