<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 15:38
 */

namespace App\Packages\Category\Resources;

use App\Packages\Article\Resources\Article;
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

        if($this->children && count($this->children)>0){
            $data['children'] = Category::collection($this->children ?? []);
        }

        if($request->has('article')){
            try{
                $data['article'] = new Article($this->article()->orderBy('sorts','desc')->first());

            }catch (\Exception $e){
                $data['article'] = [];
            }
        }

        return $data;
    }
}
