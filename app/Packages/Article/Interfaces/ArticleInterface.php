<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:23
 */

namespace App\Packages\Article\Interfaces;


interface ArticleInterface
{
    /**
     * 获取全部文章列表
     * @return mixed
     */
    public function paginate($size);

    /**
     * 查找
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * 添加文章
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * 修改文章
     * @param $data
     * @return mixed
     */
    public function update($data,$id);

    /**
     * 删除文章
     * @param $id
     * @return mixed
     */
    public function delete($id);

}
