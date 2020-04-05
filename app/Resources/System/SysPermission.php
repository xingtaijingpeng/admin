<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/11
 * Time: 22:27
 */

namespace App\Resources\System;

use App\Resources\Base;

class SysPermission extends Base
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
            'guard_name'    => $this->guard_name,
            'name'          => $this->name,
            'title'         => $this->title,
            'parent_id'     => $this->parent_id,
            'is_menu'       => $this->is_menu,
            'is_work'       => $this->is_work,
            'sorts'         => $this->sorts,
            'level'         => $this->when($this->level, $this->level),
        ];

        if($this->children){
            $data['children'] = SysPermission::collection($this->children ?? []);
        }

        return $data;
    }
}
