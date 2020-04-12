<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 11:40
 */

namespace App\Packages\Article\Controllers;

use App\Http\Controllers\Controller;
use App\Packages\Article\Interfaces\ArticleInterface;
use App\Packages\Article\Resources\Article;
use App\Packages\Article\Resources\ArticleCollection;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
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
    public function detail(Request $request,$id)
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
        $this->validate($request,[
            'title' => ['required'],
            'cover' => ['required'],
            'category_id' => ['required'],
        ],[
            'title.required' => '请填写标题',
            'cover.required' => '请上传图片',
            'category_id.required' => '请选择分类',
        ]);

        return $this->exception(function ()use($request){
            $this->article->create([
                'status' => 1,
                'user_id' => \Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'cover' => $request->cover,
                'content' => $request->content ?? '',
                'category_id' => $request->category_id,
                'url' => $request->url ?? '',
                'price' => $request->price ?? 0,
                'old_price' => $request->old_price ?? 0,
                'opened_at' => $request->opened_at ?? null,
            ]);
            return $this->success('ok');
        },true);
    }

    /**
     * 更新文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(Request $request,$id){

        $this->validate($request,[
            'title' => ['required'],
            'cover' => ['required'],
            'category_id' => ['required'],
        ],[
            'title.required' => '请填写标题',
            'cover.required' => '请上传图片',
            'category_id.required' => '请选择分类',
        ]);

        return $this->exception(function ()use($request,$id){
            $this->article->update([
                'status' => 1,
                'user_id' => \Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'cover' => $request->cover,
                'content' => $request->content ?? '',
                'category_id' => $request->category_id,
				'url' => $request->url ?? '',
				'price' => $request->price ?? 0,
				'old_price' => $request->old_price ?? 0,
				'opened_at' => $request->opened_at ?? null,
            ],$id);
            return $this->success('ok');
        },true);
    }

    /**
     * 删除文章
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function delete($id){

        return $this->exception(function ()use($id){
            $this->article->delete($id);
            return $this->success('success');
        });
    }
}
