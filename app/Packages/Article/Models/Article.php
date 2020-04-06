<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:33
 */

namespace App\Packages\Article\Models;

use Illuminate\Database\Eloquent\Model;
/**************** package config ****************/
use App\Models\System\SysCategory as BaseCategory;
use App\Models\System\SysContent as BaseContent;
/**************** package config ****************/

class Article extends Model
{
    /**
     * 获取分类
     * @return mixed
     */
    public function categories()
    {
        return $this->morphToMany(BaseCategory::class, 'categoryable');
    }

    /**
     * 获取内容
     * @return mixed
     */
    public function content()
    {
        return $this->morphMany(BaseContent::class, 'model');
    }
}
