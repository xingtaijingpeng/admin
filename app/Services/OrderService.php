<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/27
 * Time: 14:17
 */

namespace App\Services;

use App\Models\OrdTranslog;
use Omnipay\Omnipay;

class OrderService
{

	public function ali($data = []){

	    $ordTransLog = $this->mkTransLog($data['serial']);

		$gateway = Omnipay::create('Alipay_AopPage');
		$gateway->setSignType('RSA2'); // RSA/RSA2/MD5. Use certificate mode must set RSA2
		$gateway->setAppId('2021001187618161');
//		$gateway->setAppId('2021001159615431');
		$gateway->setPrivateKey(env('ALIPRIKEY'));
		$gateway->setAlipayPublicKey(env('ALIPUBKEY')); // Need not set this when used certificate mode
		$gateway->setReturnUrl('http://www.tubojiaoyu.com/backurl');
		$gateway->setNotifyUrl('http://www.tubojiaoyu.com/notify');

		/**
		 * @var AopTradePagePayResponse $response
		 */
		$response = $gateway->purchase()->setBizContent([
			'subject'      => $data['good_name'] ?? '靖鹏视频',
			'out_trade_no' => $ordTransLog['serial'] ?? '',
			'total_amount' => $data['amount'] ?? 0,
			'product_code' => 'FAST_INSTANT_TRADE_PAY',
		])->send();

		return [$response->getRedirectUrl(),$ordTransLog];
	}

	public function wx($data = []){

		$ordTransLog = $this->mkTransLog($data['serial']);

		$gateway = Omnipay::create('WechatPay_Native');

		$gateway->setAppId('wx90105c6e46750e7c');
		$gateway->setMchId('1601621453');
		$gateway->setApiKey(env('WXKEY'));
		$gateway->setNotifyUrl('http://www.tubojiaoyu.com/notify');



		$order = [
			'body'              => $data['good_name'] ?? '靖鹏视频',
			'out_trade_no'      => $ordTransLog['serial'] ?? '',
			'total_fee'         => $data['amount'] ?? 0,
			'spbill_create_ip'  => $this->getClientIP(),
			'fee_type'          => 'CNY'
		];

		$request  = $gateway->purchase($order);
		$response = $request->send();

		$res = $response->getCodeUrl();

		return [$res,$ordTransLog];
	}

	public function wx2($data = []){

		$ordTransLog = $this->mkTransLog($data['serial']);

		$gateway = Omnipay::create('WechatPay_Js');

		$gateway->setAppId('wx90105c6e46750e7c');
		$gateway->setMchId('1601621453');
		$gateway->setApiKey(env('WXKEY'));
		$gateway->setNotifyUrl('http://www.tubojiaoyu.com/notify');



		$order = [
			'body'              => $data['good_name'] ?? '靖鹏视频',
			'out_trade_no'      => $ordTransLog['serial'] ?? '',
            'open_id'           => $data['openid'],
            'total_fee'         => $data['amount'] ?? 0,
			'spbill_create_ip'  => $this->getClientIP(),
			'fee_type'          => 'CNY'
		];

		$request  = $gateway->purchase($order);
		$response = $request->send();

		$res = $response->getJsOrderData();

		return [$res,$ordTransLog];
	}

	/**
	 * 客户端IP
	 * @param int $type
	 * @return mixed
	 */
	public function getClientIP($type = 0)
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$pos = array_search('unknown', $arr);
			if (false !== $pos) unset($arr[$pos]);
			$ip = trim($arr[0]);
		} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$ip = '';
		}
		// IP地址合法验证
		$long = sprintf("%u", ip2long($ip));
		$ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
		return $ip[$type];
	}

	public function mkTransLog($serial){
	    return OrdTranslog::create([
	        'serial' => uniqid(),
	        'origin_serial' => $serial,
	        'status' => 1,
        ]);
    }
}
