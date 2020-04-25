<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/25
 * Time: 11:50
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 购买的商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function goods(Request $request)
    {
        $user = \Auth::user();

        $list = $user->orders()->paginate($this->pagesize());
        return $this->success('ok',$list);
    }
}
