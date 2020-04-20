<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/11/12
 * Time: 16:46
 */

namespace App\Http\Controllers\Admin;

use App\Models\BaseInfo;
use App\Models\Comment;
use App\Models\User;
use App\Packages\Order\Interfaces\OrderInterface;
use App\Resources\Admin\CommentCollection;
use App\Resources\Admin\OrderCollection;
use App\Resources\User as UserResource;
use App\Resources\UserCollection;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class IndexController extends InitController
{

	public function __construct(OrderInterface $order)
	{
		$this->order = $order;
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
	 * 添加评论
	 */
	public function commentcreate(Request $request)
	{
		Comment::create([
			'model_id' => $request->aid ?? 0,
			'cover' => $request->cover ?? '',
			'contents' => $request->contents ?? '',
		]);

		return $this->success('ok');
	}

	/**
	 * 删除评论
	 * @param $id
	 */
	public function commentdelete($id)
	{
		Comment::find($id)->delete();
		return $this->success('ok');
	}

	/**
	 * 评论详情
	 * @param $id
	 */
	public function commentdetail($id)
	{
		return new \App\Resources\Admin\Comment(Comment::find($id));
	}

	/**
	 * 修改评论
	 * @param $id
	 */
	public function commentupdate(Request $request,$id)
	{
		$c = Comment::find($id);

		$c->update(\Arr::except($request->toArray(),['aid']));
		return $this->success('ok');
	}

	/**
     * 基础信息
     * @param Request $request
     */
    public function baseInfo(Request $request)
    {
        $res = BaseInfo::find(1);
        return $this->success('success',[
            'logo' => $res->logo,
            'banquan' => $res->banquan,
            'banner' => json_decode($res->banner,true),
            'content' => $res->content,
        ]);

    }

    /**
     * 修改基础信息
     * @param Request $request
     */
    public function baseUpdate(Request $request)
    {
        $data = [
            'logo' => $request->logo,
            'banquan' => $request->banquan,
            'banner' => $request->banner ? json_encode($request->banner):'',
            'content' => $request->content,
        ];
        BaseInfo::where('id',1)->update(array_filter($data));

        return $this->success('success');
    }
    /**
     * @return string
     * index
     */
    public function index(){

//        $res = Redis::set('name', 'Taylor');
//        $res = Redis::get('name');
//        dd($res);

//        event(new Test());

        return 'admin';
    }

    /**
     * 发送邮件实例
     */
    public function mail(){
        $message = 'test';
        $to = '1152632628@qq.com';
        $subject = '邮件名称';
        Mail::send(
            'emails.test',
            ['content' => $message],
            function ($message) use($to, $subject) {
                $message->to($to)->subject($subject);
//                $attachment = storage_path('exports/test/xls');
//                $message->attach($attachment,['as' => 'test.xls']);
            }
        );
    }

    /**
     * 用户信息
     */
    public function userinfo(){
        $user = \Auth::user();

//        $res = Permission::create(['name' => 'edit.articles5']);

        return new UserResource($user);
    }

	/**
	 * 用户列表
	 * @param Request $request
	 */
    public function users(Request $request)
	{
		$lists = User::whereRaw('type & '.User::MEMBER_TYPE)->paginate($this->pagesize());

		return new UserCollection($lists);

	}

	/**
	 * 订单列表
	 * @param Request $request
	 * @return UserCollection
	 */
	public function orders(Request $request){

		$lists = $this->order->paginate($this->pagesize());

		return new OrderCollection($lists);
	}
}
