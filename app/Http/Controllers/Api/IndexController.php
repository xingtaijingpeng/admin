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
use App\Models\Comment;
use App\Models\OrdTranslog;
use App\Models\User;
use App\Packages\Article\Models\Article;
use App\Packages\Order\Models\OrdOrder;
use App\Resources\Admin\CommentCollection;
use App\Services\SmsService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function __construct(SmsService $service)
	{
		$this->service = $service;
	}

	public function goodcategory(Request $request)
	{
		$article = Article::find($request->id);
		$category = $article->categories()->first();
		$parent = $category->parent;
		$parent->sons->each(function ($item){
			$item->article;
		});
		return $this->success('ok',$parent);
	}

	/**
	 * 回调跳转
	 * @param Request $request
	 */
	public function backurl(Request $request)
	{
		$serial = $request->out_trade_no ?? '';
		$translog = OrdTranslog::where('serial',$serial)->first();
		$order = OrdOrder::where('serial',$translog['origin_serial'])->first();

		header("Location: /index.html#/ClassDetails/".$order['good_id']);

	}

    /**
     * 回调
     * @param Request $request
     */
    public function notify(Request $request){

		$options = array_merge($_POST, $_GET);

		if(empty($options)){
			$options = file_get_contents('php://input');
			$options = (array)simplexml_load_string($options, 'SimpleXMLElement', LIBXML_NOCDATA);
		}

		$serial = $options['out_trade_no'] ?? $options['orderId'];

		$translog = OrdTranslog::where('serial',$serial)->first();
		$translog->update([
			'status' => 2,
		]);
		OrdOrder::where('serial',$translog['origin_serial'])->update([
			'status' => 2,
			'payed_at' => date('Y-m-d H:i:s'),
		]);
        echo 'success';
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
	 * 判断是否购买
	 * @param $id
	 */
    public function hasbuy($id)
	{
		$user = \Auth::user();
		$art = Article::find($id)->categories()->first();
		$order = $user->orders()->where([
			'status' => 2,
			'cate_id' => $art->id,
		])->first();

		return $this->success('success',[
			'isbuy' => $order ? 1 : 0
		]);
	}

    /**
     * 评论列表
     * @param $id
     */
    public function comment($id)
    {
        $lists = Comment::where('model_id',$id)->orderBy('id','DESC')->paginate($this->pagesize());

        return new CommentCollection($lists);
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
			'token' => $token,
            'user' => $user,
		]);
    }

    /**
     * 更改头像
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeCover(Request $request)
    {
        $user = \Auth::user();
        $user->avatar = $request->cover;
        $user->save();
        return $this->success('success');
    }

    /**
     * 修改密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password_old' => ['required'],
            'password' => ['required','confirmed'],
        ], [
            'password_old.required' => '缺少原始密码',
            'password.required' => '缺少新密码',
            'password.confirmed' => '确认新密码不匹配',
        ]);

        try {

            $user = \Auth::user();

            if(!\Hash::check($request['password_old'],$user->password)){
                return $this->error('原始密码错误');
            }

            $user->password = bcrypt($request->password);
            $user->save();

            return $this->success('success');

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * 用户信息
     */
    public function userinfo(){
        $user = \Auth::user();

        $year = date('Y')*1;
        $kaoshishijian = strtotime($year.'-11-10 00:00:00');

        if(time() > $kaoshishijian){
            $year++;
        }

        $need = strtotime($year.'-11-10 00:00:00');

        $needday = (int)(($need-time())/(3600*24));

        $user->needay = $needday;

		return $this->success('success',$user);
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
                'user' => $user,
                'token' => $token ?? ''
			]);

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
	public function forget(Request $request)
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

			$user = User::where([
				'mobile' => $request->mobile
			])->first();

			$user->password = bcrypt($request->password);

			$user->save();

			$token = auth('admin')->login($user);

			return $this->success('success',[
                'user' => $user,
                'token' => $token ?? ''
			]);

		} catch (\Exception $e) {
			return $this->error($e->getMessage());
		}
	}

	public function userinfosave(Request $request)
    {
        $from = $request->from ?? [];

        $user = \Auth::user();

        $user->update($from);

        return $this->success('ok');

    }
}
