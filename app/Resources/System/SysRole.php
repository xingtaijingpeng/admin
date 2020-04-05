<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/16
 * Time: 10:17
 */

namespace App\Resources\System;

use App\Resources\Base;

class SysRole extends Base
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id'            => $this->id,
            'name'          => $this->name,
            'guard_name'    => $this->guard_name,
            'title'         => $this->title,
            'is_work'       => $this->is_work,
        ];

        if($request->permission){
            $data['permission'] = $this->permissions()->pluck('id');
        }

        return $data;
    }
}