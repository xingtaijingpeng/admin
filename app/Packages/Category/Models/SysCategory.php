<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 22:37
 */

namespace App\Packages\Category\Models;

use Illuminate\Database\Eloquent\Model;
/**************** package config ****************/
use App\Packages\Article\Models\Article as PackageArticle;
/**************** package config ****************/

class SysCategory extends Model
{
    protected $guarded = [];

    /**
     * 获取所有分配该分类的文章 (文章扩展)
     */
    public function article()
    {
        return $this->morphedByMany(PackageArticle::class, 'sys_categoriable');
    }

    public function parent(){
    	return $this->belongsTo(SysCategory::class,'parent_id');
	}

	public function sons(){
    	return $this->hasMany(SysCategory::class,'parent_id');
	}
}
