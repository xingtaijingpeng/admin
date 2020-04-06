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
     * 通过ID获取文章列表
     * @param $id
     * @return mixed
     */
    public function getListByUser($id);

    /**
     * 添加文章
     * @param $data
     * @return mixed
     */
    public function create($data);
}
