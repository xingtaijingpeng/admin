<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/25
 * Time: 11:50
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrdTranslog;
use App\Packages\Article\Models\Article;
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

		$this->validate($request, [
			'good_id' => ['required'],
			'type' => ['required'],
		], [
			'good_id.required' => '暂无视频',
			'type.required' => '缺少支付方式',
		]);

		$goodInfo = Article::find($request->good_id);

		$user = \Auth::user();

		$order = $user->orders()->create([
			'status' => 1,
			'pay_type' => $request->type,
			'serial' => date('YmdHis').$user['id'].rand(100,999),
			'good_id' => $goodInfo['id'],
			'good_name' => $goodInfo['title'],
			'price' => $goodInfo['price'],
			'old_price' => $goodInfo['price'],
		]);
		if($request->type == 1){

			list($url,$ordTransLog) = $this->orderService->wx([
				'good_name' => '靖鹏视频',
				'serial' => $order['serial'],
				'amount' => $order['price']
			]);

			return $this->success('success',[
				'url' => $url,
				'ordTransLog' => $ordTransLog
			]);

		}else{
			list($url,$ordTransLog) = $this->orderService->ali([
				'good_name' => '靖鹏视频',
				'serial' => $order['serial'],
				'amount' => round(($order['price']*1)/100,2)
			]);
			return $this->success('success',[
				'url' => $url,
				'ordTransLog' => $ordTransLog
			]);
		}

	}

	/**
	 * 再次支付订单
	 * @param Request $request
	 */
	public function repayorder(Request $request)
	{
		$orderid = $request->orderid ?? 0;
		$type = $request->type ?? 1;

		$order = OrdOrder::find($orderid);

		//weixin
		if($type == 1){
			list($url,$ordTransLog) = $this->orderService->wx([
				'good_name' => '靖鹏视频',
				'serial' => $order['serial'],
				'amount' => $order['price'],
			]);
		}else{
			list($url,$ordTransLog) = $this->orderService->ali([
				'good_name' => '靖鹏视频',
				'serial' => $order['serial'],
				'amount' => round($order['price']/100,2),
			]);

		}

        return $this->success('success',[
            'url' => $url,
			'ordTransLog' => $ordTransLog
		]);

	}

	/**
	 * 删除订单
	 * @param Request $request
	 */
	public function orderdelete(Request $request){
		$id= $request->id ?? 0;

		OrdOrder::where('id',$id)->delete();

		return $this->success('ok');
	}

	/**
	 * 查询支付是否成功
	 * @param Request $request
	 */
	public function ordercheck(Request $request){

		$serial = $request->serial ?? '';

		$translog = OrdTranslog::where('serial',$serial)->first();

		if($translog['status'] == 2){
			return $this->success('ok');
		}else{
			return $this->error('no');
		}
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
