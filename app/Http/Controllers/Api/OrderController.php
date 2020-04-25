<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/25
 * Time: 11:50
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Resources\Api\MessageCollection;
use App\Resources\Api\OrdOrderCollection;
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

        $list = $user->orders()->where($request->toArray())->orderBy('id','DESC')->paginate($this->pagesize());

        return new OrdOrderCollection($list);
    }

    /**
     * 购买的商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function message(Request $request)
    {
        $user = \Auth::user();

        $list = $user->messages()->where($request->toArray())->orderBy('id','DESC')->paginate($this->pagesize());

        return new MessageCollection($list);
    }
}
