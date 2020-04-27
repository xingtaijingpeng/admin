<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/25
 * Time: 11:50
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Packages\Order\Models\OrdOrder;
use App\Resources\Api\MessageCollection;
use App\Resources\Api\OrdOrderCollection;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function __construct(OrderService $orderService)
	{
		$this->orderService = $orderService;
	}

	/**
	 * 下订单
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function mkorder(Request $request)
	{

		$url = $this->orderService->wx();
		return $this->success('success',[
		    'url' => $url
        ]);
	}

	/**
	 * 再次支付订单
	 * @param Request $request
	 */
	public function repayorder(Request $request)
	{
		$orderid = $request->orderid ?? 0;

		$order = OrdOrder::find($orderid);

        $url = $this->orderService->ali([
            'good_name' => '靖鹏视频',
            'serial' => '123456789123456789',
            'amount' => 0.01,
        ]);

        return $this->success('success',[
            'url' => $url
        ]);

	}

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
