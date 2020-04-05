<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:33
 */

namespace App\Packages\Article\Models;


use App\Packages\Category\Model\Category;

class Article
{
    /**
     * 获取指定文章所有分类
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }
}
