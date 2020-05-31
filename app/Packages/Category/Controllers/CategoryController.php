<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/7
 * Time: 15:32
 */

namespace App\Packages\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Packages\Category\Interfaces\CategoryInterface;
use App\Packages\Category\Resources\Category;
use App\Packages\Category\Resources\CategoryCollection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * 仓库
     * @var ArticleInterface
     */
    private $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * 分类列表不分页
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return new CategoryCollection($this->category->all($request->guard));
    }

    /**
     * 分类详情
     * @param $id
     * @return Article
     */
    public function detail(Request $request,$id)
    {
        return new Category($this->category->find($id));
    }

    /**
     * 添加分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'guard' => ['required'],
            'name' => ['required'],
        ],[
            'guard.required' => '请填写Guard',
            'name.required' => '请填写分类名称',
        ]);

        return $this->exception(function ()use($request){
            $this->category->create([
                'status' => 1,
                'guard' => $request->guard,
                'name' => $request->name,
                'zip_url' => $request->zip_url,
                'parent_id' => $request->parent_id ?? 0,
            ]);
            return $this->success('ok');
        },true);
    }

    /**
     * 更新分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(Request $request,$id){

        $this->validate($request,[
            'guard' => ['required'],
            'name' => ['required'],
        ],[
            'guard.required' => '请填写Guard',
            'name.required' => '请填写分类名称',
        ]);

        return $this->exception(function ()use($request,$id){
            $this->category->update([
                'status' => $request->status ?? 1,
                'guard' => $request->guard,
                'sort' => $request->sort,
                'zip_url' => $request->zip_url,
                'name' => $request->name,
                'parent_id' => $request->parent_id ?? 0,
            ],$id);
            return $this->success('ok');
        },true);
    }

    /**
     * 删除分类
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function delete($id){

        return $this->exception(function ()use($id){
            $this->category->delete($id);
            return $this->success('success');
        });
    }
}
