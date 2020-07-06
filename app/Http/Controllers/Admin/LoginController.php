<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/30
 * Time: 12:08
 */

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;

class LoginController extends InitController
{

	public function __construct(SmsService $service)
	{
		$this->service = $service;
	}

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
            'token' => $token,
            'user' => $user,
            'role' => $user->roles()->first(),
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
	 * @param Request $request
	 */
    public function sms(Request $request)
	{
		$this->validate($request, [
			'mobile' => ['required','exists:users'],
		], [
			'mobile.required' => '请填写手机号',
			'mobile.exists' => '管理员不存在',
		]);

		try {
			$this->service->index($request->mobile);
			return $this->success('发送成功');

		} catch (\Exception $e) {
			return $this->error($e->getMessage());
		}
	}

	/**
	 * 重置密码
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function forget(Request $request){

		$this->validate($request, [
			'mobile' => ['required'],
			'password' => ['required','confirmed'],
			'code' => ['required',function($attribute, $value, $fail) use($request) {
				if ($value != $this->service->getCode($request->mobile)) {
					return $fail('验证码错误');
				}
			},],
		], [
			'mobile.required' => '请填写手机号',
			'password.required' => '缺少密码',
			'password.confirmed' => '确认密码不匹配',
			'code.required' => '缺少code',
			'code.same' => '验证码错误',
		]);



		$user = User::where('mobile',$request->mobile)->first();

		$user->password = bcrypt($request->password);

		$user->save();

		$token = auth('admin')->login($user);

		return $this->success('success',[
			'token' => $token ?? ''
		]);
	}

}
