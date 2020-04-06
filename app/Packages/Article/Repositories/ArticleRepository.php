<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:23
 */

namespace App\Packages\Article\Repositories;


use App\Packages\Article\Interfaces\ArticleInterface;
use App\Packages\Article\Models\Article;

class ArticleRepository implements ArticleInterface
{

    /**
     * 获取全部文章列表
     * @return mixed
     */
    public function all()
    {
        return Article::all();
    }

    /**
     * 通过ID获取文章列表
     * @param $id
     * @return mixed
     */
    public function getListByUser($id)
    {
        // TODO: Implement getListById() method.
    }

    /**
     * 添加文章
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $art = Article::create(\Arr::except($data,['content','category_id']));
        $art->content()->create([
            'content' => $data['content']
        ]);
        $art->categories()->sync([
            'sys_category_id' => $data['category_id']
        ]);
        return $art;
    }
}
