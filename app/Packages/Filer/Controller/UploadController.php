<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/31
 * Time: 16:03
 */

namespace App\Packages\Filer\Controller;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Packages\Filer\Interfaces\UploadInterface;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    use ResponseTrait;

    protected $upload;

    /**
     * UploadController constructor.
     * @param UploadInterface $upload
     * 注册仓库
     */
    public function __construct(UploadInterface $upload)
    {
        $this->upload = $upload;
    }

    /**
     * @param Request $request
     * @return mixed
     * 图片上传
     */
    public function image(Request $request)
    {
        return $this->exception(function ()use($request){

            $uploadFile = $request->file('file') ?? [];

            $this->checkMimeTypes($uploadFile,[
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/bmp',
                'image/svg+xml',
            ]);

            $url = config('app.url').'/'.$this->upload->image('storage/images/'.date('Y/m/d'),$uploadFile);

            return $this->success('上传成功',$url);

        });
    }

    /**
     * @param Request $request
     * @return mixed
     * 上传excel
     */
    public function excel(Request $request)
    {
        $urls = $this->upload->excel('storage/excel/'.date('Y/m/d'),$request->file('files'));
        return $this->success('上传成功',$urls);
    }

    /**
     * @param Request $request
     * @return mixed
     * 删除文件
     */
    public function remove(Request $request)
    {
        $result = $this->upload->remove($request->path ?? '');
        return $this->success('删除成功',$result);
    }

    /**
     * 验证允许文件类型
     * @param $files
     * @param $allowedTypes
     */
    public function checkMimeTypes($file,$allowedTypes){
        if(!in_array($file->getMimeType(), $allowedTypes)){
            throw new \Exception('文件类型错误');
        }
        if(!$file->isValid()){
            throw new \Exception('上传图片异常');
        }
    }
}
