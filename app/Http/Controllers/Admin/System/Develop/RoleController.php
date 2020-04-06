<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/16
 * Time: 10:04
 */

namespace App\Http\Controllers\Admin\System\Develop;

use App\Http\Controllers\Admin\InitController;
use App\Models\System\SysRole;
use App\Resources\System\SysRole as SysRoleResource;
use App\Resources\System\SysRoleCollection;
use Illuminate\Http\Request;

class RoleController extends InitController
{
    /**
     * @param Request $request
     * @return SysRoleCollection
     * 角色列表
     */
    public function index(Request $request)
    {
        $roles = SysRole::where([
            'guard_name' => config('auth.defaults.guard'),
        ])->orderBy('id','asc')->paginate($this->pagesize());

        return new SysRoleCollection($roles);
    }

    /**
     * @param Request $request
     * 角色详情
     */
    public function detail(Request $request, SysRole $model = null){
        return new SysRoleResource($model);
    }

    /**
     * @param Request $request
     * 创建角色
     */
    public function create(Request $request){
        $data = $request->data ?? [];

        $validator = validator($data, [
            'title' => ['required'],
            'name' => ['required','unique:sys_roles'],
        ], [
            'title.required' => '请填写显示名称',
            'name.required' => '请填权限名称',
            'name.unique' => '权限名称已存在',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $model = SysRole::create($data);
        $model->syncPermissions($request->permission ?? []);

        return $this->success('success');
    }

    /**
     * @param Request $request
     * 角色更新
     */
    public function update(Request $request,SysRole $model = null){
        $data = $request->data ?? [];

        $validator = validator($data, [
            'title' => ['required'],
            'name' => ['required','unique:sys_roles,name,'.$model->id],
        ], [
            'title.required' => '请填写显示名称',
            'name.required' => '请填权限名称',
            'name.unique' => '角色名称已存在',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $model->update($data);
        $model->syncPermissions($request->permission ?? []);

        return $this->success('success');
    }

    /**
     * @param ysPermission|null $model
     * 角色删除(与之关联的关系都删除)
     */
    public function delete(SysRole $model = null){

        $this->exception(function () use ($model){
            $model->delete();
        });
        return $this->success('success');
    }
}
