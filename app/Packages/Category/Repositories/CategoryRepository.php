<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 15:02
 */

namespace App\Packages\Category\Repositories;


use App\Packages\Category\Interfaces\CategoryInterface;
use App\Packages\Category\Models\SysCategory;

class CategoryRepository implements CategoryInterface
{

    /**
     * 获取全部分类列表
     * @return mixed
     */
    public function all($guard)
    {
        $category = SysCategory::where('guard',$guard);

        if(request('parent_id')){
            $category = $category->where('parent_id',request('parent_id'));

            return $category->get();
        }

        $category = $category->get()->buildTree();
        if(request()->merge){
            $category = $category->mergeTree();
        }
        return $category;
    }

    /**
     * 查找
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return SysCategory::find($id);
    }

    /**
     * 添加分类
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return SysCategory::create($data);
    }

    /**
     * 修改分类
     * @param $data
     * @return mixed
     */
    public function update($data, $id)
    {
        return SysCategory::where('id', $id)->update($data);
    }

    /**
     * 删除分类
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return SysCategory::where('id',$id)->update([
            'status' => 2
        ]);
    }
}
