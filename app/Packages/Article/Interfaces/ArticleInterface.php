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
    public function all();

    /**
     * 通过ID获取文章列表
     * @param $id
     * @return mixed
     */
    public function getListById($id);
}
