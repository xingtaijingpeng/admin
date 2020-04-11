<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/11/12
 * Time: 16:46
 */

namespace App\Http\Controllers\Admin;

use App\Models\BaseInfo;
use App\Resources\User as UserResource;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class IndexController extends InitController
{
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
}
