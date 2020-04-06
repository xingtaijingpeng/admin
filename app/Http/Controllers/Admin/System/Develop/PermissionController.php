<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 22:29
 */

namespace App\Http\Controllers\Admin\System\Develop;

use App\Http\Controllers\Admin\InitController;
use App\Models\System\SysPermission;
use App\Resources\System\SysPermission as SysPermissionResource;
use App\Resources\System\SysPermissionCollection;
use Illuminate\Http\Request;

class PermissionController extends InitController
{
    /**
     * @param Request $request
     * 获取权限列表
     */
    public function index(Request $request)
    {
        $where = [
            'guard_name' => config('auth.defaults.guard'),
        ];

        if($request->menu){
           $where['is_menu'] = SysPermission::IS_MENU;
           $where['is_work'] = SysPermission::IS_WORK;
        }

        $permission = SysPermission::where($where)->orderBy('sorts','DESC')->get()->buildTree();

        if($request->merge){
            $permission = $permission->mergeTree();
        }

        return new SysPermissionCollection($permission);
    }

    /**
     * @param Request $request
     * 权限详情
     */
    public function detail(Request $request, SysPermission $model = null){
        return new SysPermissionResource($model);
    }

    /**
     * @param Request $request
     * 创建权限
     */
    public function create(Request $request){

        $data = $request->data ?? [];

        $validator = validator($data, [
            'title' => ['required'],
            'name' => ['required','unique:sys_permissions'],
        ], [
            'title.required' => '请填写显示名称',
            'name.required' => '请填权限名称',
            'name.unique' => '权限名称已存在',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        SysPermission::create($data);

        return $this->success('success');
    }

    /**
     * @param Request $request
     * 权限更新
     */
    public function update(Request $request,SysPermission $model = null){
        $data = $request->data ?? [];

        $validator = validator($data, [
            'title' => ['required'],
            'name' => ['required','unique:sys_permissions,name,'.$model->id],
        ], [
            'title.required' => '请填写显示名称',
            'name.required' => '请填权限名称',
            'name.unique' => '权限名称已存在',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $model->update($data);

        return $this->success('success');
    }

    /**
     * @param ysPermission|null $model
     * 权限删除
     */
    public function delete(SysPermission $model = null){
        $permission = SysPermission::getPermissions([
            'parent_id' => $model['id']
        ])->count();

        if($permission > 0){
            return $this->error('请删除全部子模块');
        }
        $this->exception(function () use ($model){
            $model->delete();
        });
        return $this->success('success');
    }
}
