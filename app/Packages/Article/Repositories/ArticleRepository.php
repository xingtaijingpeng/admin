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
    public function paginate($size)
    {
        return Article::whereHas('categories',function ($query){
            $query->where('guard',request('guard'));
        })->paginate($size);
    }

    /**
     * 获取详情
     * @param $id
     * @return mixed
     */
    public function find($id){
        return Article::find($id);
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

    /**
     * 修改文章
     * @param $data
     * @param $id
     * @return array
     */
    public function update($data,$id){
        $art = Article::find($id);
        $art->update(\Arr::except($data,['content','category_id']));
        $art->content()->delete();
        $art->content()->create([
            'content' => $data['content']
        ]);
        $art->categories()->sync([
            'sys_category_id' => $data['category_id']
        ]);
        return $art;
    }

    /**
     * 删除文章
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $art = Article::find($id);
        $art->content()->delete();
        $art->categories()->sync([]);
        $art->delete();
        return true;
    }
}
