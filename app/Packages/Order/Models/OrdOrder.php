<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/16
 * Time: 17:40
 */

namespace App\Packages\Order\Models;

use App\Models\User;
use App\Packages\Article\Models\Article;
use Illuminate\Database\Eloquent\Model;

class OrdOrder extends Model
{
	protected $guarded = [];

	public function user(){
		return $this->belongsTo(User::class,'user_id');
	}

	public function good(){
		return $this->belongsTo(Article::class,'good_id');
	}

}
