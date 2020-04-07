<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 15:01
 */

namespace App\Packages\Category\Interfaces;


interface CategoryInterface
{
    /**
     * 获取全部分类列表
     * @return mixed
     */
    public function paginate($size,$guard);

    /**
     * 查找
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * 添加分类
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * 修改分类
     * @param $data
     * @return mixed
     */
    public function update($data,$id);

    /**
     * 删除分类
     * @param $id
     * @return mixed
     */
    public function delete($id);
}