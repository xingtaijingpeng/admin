<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/11/12
 * Time: 16:47
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BaseInfo;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;

class IndexController extends Controller
{

	public function __construct(SmsService $service)
	{
		$this->service = $service;
	}

    /**
     * @return string
     * index
     */
    public function base(){

        //获取基本信息

        $base = BaseInfo::find(1);
        $base->banner = json_decode($base->banner,true);
        return $this->success('ok',$base);
    }

    /**
     * 获取token
     */
    public function token(Request $request){

		$this->validate($request, [
			'mobile' => ['required'],
			'password' => ['required'],
		], [
			'mobile.required' => '请填写手机号',
			'password.required' => '请填写密码',
		]);


		$user = User::where('mobile',$request['mobile'])->first();

		if(!$user){
			return $this->error('当前手机号未注册');
		}

		if(!\Hash::check($request['password'],$user->password)){
			return $this->error('密码错误');
		}
		$token = auth('admin')->login($user);

		return $this->success('success',[
			'token' => $token
		]);
    }

    /**
     * 用户信息
     */
    public function userinfo(){
        $user = \Auth::user();

		return $this->success('success',[
			'user' => $user
		]);
    }

	/**
	 * 发送短信
	 * @param Request $request
	 */
	public function sms(Request $request)
	{
		$this->validate($request, [
			'mobile' => ['required','digits:11'],
		], [
			'mobile.required' => '请填写手机号',
			'mobile.digits' => '请填写正确手机号',
		]);

		try {
			$this->service->index($request->mobile);
			return $this->success('发送成功');

		} catch (\Exception $e) {
			return $this->error($e->getMessage());
		}
	}

	/**
	 * 注册用户
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function register(Request $request)
	{
		$this->validate($request, [
			'mobile' => ['required','digits:11'],
			'password' => ['required','confirmed'],
			'code' => ['required',function($attribute, $value, $fail) use($request) {
				if ($value != $this->service->getCode($request->mobile)) {
					return $fail('验证码错误');
				}
			},],
		], [
			'mobile.required' => '请填写手机号',
			'mobile.digits' => '请填写正确手机号',
			'password.required' => '缺少密码',
			'password.confirmed' => '确认密码不匹配',
			'code.required' => '缺少code',
			'code.same' => '验证码错误',
		]);

		try {

			$user = User::firstOrCreate([
				'mobile' => $request->mobile
			],[
				'password' => bcrypt($request->password),
				'type' => User::MEMBER_TYPE
			]);

			$user->password = bcrypt($request->password);

			$user->save();

			$token = auth('admin')->login($user);

			return $this->success('success',[
				'token' => $token ?? ''
			]);

		} catch (\Exception $e) {
			return $this->error($e->getMessage());
		}
	}
}
