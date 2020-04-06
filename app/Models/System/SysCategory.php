<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 22:37
 */

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
/**************** package config ****************/
use App\Packages\Article\Models\Article as PackageArticle;
/**************** package config ****************/

class SysCategory extends Model
{
    /**
     * 获取所有分配该分类的文章 (文章扩展)
     */
    public function article()
    {
        return $this->morphedByMany(PackageArticle::class, 'categoryable');
    }
}
