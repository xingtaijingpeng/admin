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
use App\Packages\Category\Models\SysCategory as BaseCategory;
use App\Models\System\SysContent as BaseContent;
use App\Models\User as BaseUser;
/**************** package config ****************/

class Article extends Model
{
    protected $guarded = [];
    /**
     * 获取分类
     * @return mixed
     */
    public function categories()
    {
        return $this->morphToMany(BaseCategory::class, 'sys_categoriable');
    }

    /**
     * 获取内容
     * @return mixed
     */
    public function content()
    {
        return $this->morphOne(BaseContent::class, 'model');
    }

	/**
	 * 创建者
	 * @return mixed
	 */
    public function user(){
    	return $this->belongsTo(BaseUser::class,'user_id');
	}
}
