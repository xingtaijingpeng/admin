<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:40
 */

namespace App\Packages\Article\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Packages\Article\Interfaces\ArticleInterface;
use App\Packages\Article\Resources\Article;
use App\Packages\Article\Resources\ArticleCollection;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ResponseTrait;

    private $article;

    public function __construct(ArticleInterface $article)
    {
        $this->article = $article;
    }

    /**
     * 文章列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return new ArticleCollection($this->article->paginate($this->pagesize()));
    }

    /**
     * 文章详情
     * @param $id
     * @return Article
     */
    public function detail($id)
    {
        return new Article($this->article->find($id));
    }

    /**
     * 添加文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        return $this->exception(function (){
            $this->article->create([
                'status' => 1,
                'user_id' => \Auth::user()->id,
                'title' => '测试标题',
                'cover' => '缩略图',
                'content' => '这里是文章内容',
                'category_id' => 1
            ]);
            return $this->success('ok');
        },true);
    }

    public function delete($id){

        return $this->exception(function ()use($id){
            $this->article->delete($id);
            return $this->success('success');
        });
    }
}
