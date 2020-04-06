<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/11/12
 * Time: 16:48
 */

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @return string
     * index
     */
    public function index(){
        return 'tenant';
    }

    /**
     * 获取token
     */
    public function token(){
        $user = User::find(1);
        $token = auth('tenant')->login($user);
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
