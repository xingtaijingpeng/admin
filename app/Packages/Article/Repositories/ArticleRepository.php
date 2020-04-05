<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:23
 */

namespace App\Packages\Article\Repositories;


use App\Packages\Article\Interfaces\ArticleInterface;

class ArticleRepository implements ArticleInterface
{

    /**
     * 获取全部文章列表
     * @return mixed
     */
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * 通过ID获取文章列表
     * @param $id
     * @return mixed
     */
    public function getListById($id)
    {
        // TODO: Implement getListById() method.
    }
}
