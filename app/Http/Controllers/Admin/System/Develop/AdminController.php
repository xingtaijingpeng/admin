<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/10
 * Time: 17:50
 */

namespace App\Http\Controllers\Admin\System\Develop;

use App\Http\Controllers\Admin\InitController;
use App\Models\User;
use App\Resources\System\SysAdmin;
use App\Resources\System\SysAdminCollection;
use Illuminate\Http\Request;

class AdminController extends InitController
{
    /**
     * @param Request $request
     * @return SysRoleCollection
     * Admin管理员列表
     */
    public function index(Request $request)
    {
        $admin = User::whereRaw('type & '.User::ADMIN_TYPE)->orderBy('id','asc')->paginate($this->pagesize());
        return new SysAdminCollection($admin);
    }

    /**
     * @param Request $request
     * 创建管理员
     */
    public function create(Request $request){

        $this->validate($request, [
            'mobile' => ['required'],
            'name' => ['required'],
            'avatar' => ['required'],
            'role' => ['required'],
            'password' => ['required'],
        ], [
            'mobile.required' => '请填写显示名称',
            'name.required' => '请填权限名称',
            'avatar.required' => '请填权限名称',
            'role.required' => '请填权限名称',
            'password.required' => '请填权限名称',
        ]);

        $model = User::firstOrCreate([
            'mobile' => $request->mobile,
        ],\Arr::except($request->toArray(),['role','mobile']));

        $model->syncRoles([$request->role]);

        $model->password = bcrypt($request->password);
        $model->save();


        if(!($model->type & User::ADMIN_TYPE)){
            $model->type += User::ADMIN_TYPE;
            $model->save();
        }

        return $this->success('success');
    }

    /**
     * @param Request $request
     * 角色管理员
     */
    public function update(Request $request,User $model = null){

        $this->validate($request, [
            'mobile' => ['required'],
            'name' => ['required'],
            'avatar' => ['required'],
            'role' => ['required'],
            'password' => ['required'],
        ], [
            'mobile.required' => '请填写显示名称',
            'name.required' => '请填权限名称',
            'avatar.required' => '请填权限名称',
            'role.required' => '请填权限名称',
            'password.required' => '请填权限名称',
        ]);

        $model->update(\Arr::except($request->toArray(),['role','password']));

        $model->syncRoles([$request->role]);

        if($request->password != '********'){
            $model->password = bcrypt($request->password);
            $model->save();
        }

        return $this->success('success');
    }

    /**
     * 管理员详情
     * @param User|null $model
     * @return SysAdmin
     */
    public function detail(User $model = null)
    {
        return new SysAdmin($model);
    }
}
