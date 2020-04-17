<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/15
 * Time: 11:34
 */

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class SmsService
{

	public function index($mobile,$prefix = 'code_forget_'){

		if(Redis::get($prefix.$mobile)){
			throw new \Exception('1分钟只允许发送一条');
		}
		$code = rand(100000,999999);
		AlibabaCloud::accessKeyClient(env('ALIKEY'), env('ALIPWD'))
			->regionId('cn-hangzhou')
			->asDefaultClient();

		AlibabaCloud::rpc()
			->product('Dysmsapi')
			->version('2017-05-25')
			->action('SendSms')
			->method('POST')
			->host('dysmsapi.aliyuncs.com')
			->options([
				'query' => [
					'RegionId' => "cn-hangzhou",
					'PhoneNumbers' => "{$mobile}",
					'SignName' => "TinyUse微用",
					'TemplateCode' => "SMS_68070321",
					'TemplateParam' => json_encode([
						"code" => $code
					]),
				],
			])
			->request();

		Redis::setex($prefix.$mobile, 60, $code);

	}

	public function getCode($mobile,$eprefix = 'code_forget_'){
		return Redis::get($eprefix.$mobile);
	}
}
