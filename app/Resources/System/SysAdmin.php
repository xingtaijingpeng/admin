<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/10
 * Time: 17:53
 */

namespace App\Resources\System;

use App\Resources\Base;

class SysAdmin extends Base
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mobile' => $this->mobile,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'created_at' => $this->created_at,
            'email' => $this->email,
            'role' => \Arr::first($this->roles) ?? 0,
        ];
    }
}
