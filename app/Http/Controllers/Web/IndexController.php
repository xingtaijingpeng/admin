<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/11/12
 * Time: 16:48
 */

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * @return string
     * index
     */
    public function index(){
        return 'web';
    }

    /**
     * 获取token
     */
    public function token(){
        $user = User::find(1);
        auth('web')->login($user);
        return redirect(url('userinfo'));
    }

    /**
     * 用户信息
     */
    public function userinfo(){
        $user = \Auth::user();

        dd($user);
    }

    /**
     * 登出
     */
    public function logout(){
        auth('web')->logout();

    }
}
