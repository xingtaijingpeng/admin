<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 22:37
 */

namespace App\Models\Base;


use App\Packages\Article\Models\Article;

class Category
{
    /**
     * 获取所有分配该分类的文章
     */
    public function article()
    {
        return $this->morphedByMany(Article::class, 'categoryable');
    }
}
