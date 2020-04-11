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
        $data = [
            'id'            => $this->id,
            'name'          => $this->name,
            'sort'         => $this->sort,
            'status'        => $this->status,
            'parent_id'     => $this->parent_id,
            'level'         => $this->when($this->level, $this->level),

        ];

        if($this->children){
            $data['children'] = SysPermission::collection($this->children ?? []);
        }

        return $data;
    }
}
