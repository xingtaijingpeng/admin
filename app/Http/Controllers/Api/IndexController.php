<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/11/12
 * Time: 16:47
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BaseInfo;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * @return string
     * index
     */
    public function base(){

        //获取基本信息

        $base = BaseInfo::find(1);
        $base->banner = json_decode($base->banner,true);
        return $this->success('ok',$base);
    }

    /**
     * 获取token
     */
    public function token(){
        $user = User::find(1);
        $token = auth('api')->login($user);
        dd($token);
    }

    /**
     * 用户信息
     */
    public function userinfo(){
        $user = \Auth::user();

        dd($user);
    }
}
