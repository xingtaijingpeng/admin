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
        return $this->success('ok',$this->article->getList());
    }
}
