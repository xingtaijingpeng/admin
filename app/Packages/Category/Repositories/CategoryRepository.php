<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 15:02
 */

namespace App\Packages\Category\Repositories;


use App\Packages\Category\Interfaces\CategoryInterface;

class CategoryRepository implements CategoryInterface
{

    /**
     * 获取全部分类列表
     * @return mixed
     */
    public function paginate($size)
    {
        // TODO: Implement paginate() method.
    }

    /**
     * 查找
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * 添加分类
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        // TODO: Implement create() method.
    }

    /**
     * 修改分类
     * @param $data
     * @return mixed
     */
    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    /**
     * 删除分类
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}