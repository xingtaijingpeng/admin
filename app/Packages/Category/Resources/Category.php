<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 15:38
 */

namespace App\Packages\Category\Resources;

use App\Resources\Base;

class Category extends Base
{
    public function toArray($request)
    {
        return [
            'id' => $this->id
        ];
    }
}