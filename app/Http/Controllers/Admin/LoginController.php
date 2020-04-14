<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/30
 * Time: 12:08
 */

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class LoginController extends InitController
{

    /**
     * 获取token
     */
    public function token(Request $request){

        $data = $request->data ?? [];

        $validator = validator($data, [
            'mobile' => ['required'],
            'password' => ['required'],
        ], [
            'mobile.required' => '请填写手机号',
            'password.required' => '请填密码',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $user = User::where('mobile',$data['mobile'])->first();

        if(!$user){
            return $this->error('当前手机号未注册');
        }

        if(!\Hash::check($data['password'],$user->password)){
            return $this->error('密码错误');
        }
        $token = auth('admin')->login($user);

        return $this->success('success',[
            'token' => $token
        ]);
    }

    /**
     * 刷新token
     */
    public function refresh(){
        return $this->success('success',[
            'token' => auth('admin')->refresh()
        ]);
    }

    /**
     * @return mixed
     * 退出登录
     */
    public function logout()
    {
        auth('admin')->logout();
        return $this->success('success');
    }

	/**
	 * 发送短信
	 */
    public function sms()
	{

		AlibabaCloud::accessKeyClient('LTAIHu0bFK0fG3Ia', 'j2ie4qdir49cML0ixR6ggjo8FcmLfI')
			->regionId('cn-hangzhou')
			->asDefaultClient();

		try {
			$result = AlibabaCloud::rpc()
				->product('Dysmsapi')
				->version('2017-05-25')
				->action('SendSms')
				->method('POST')
				->host('dysmsapi.aliyuncs.com')
				->options([
					'query' => [
						'RegionId' => "cn-hangzhou",
						'PhoneNumbers' => "18310319013",
						'SignName' => "TinyUse微用",
						'TemplateCode' => "SMS_68070321",
						'TemplateParam' => '{"code":"123456"}',
					],
				])
				->request();
			info($result->toArray());
		} catch (ClientException $e) {
			info($e->getMessage());
		} catch (ServerException $e) {
			info($e->getMessage());
		}
	}

}
