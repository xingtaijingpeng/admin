<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/31
 * Time: 14:28
 */

namespace App\Packages\Filer\Interfaces;

use Illuminate\Http\UploadedFile;

interface UploadInterface
{
    /**
     * @return mixed
     * 图片上传
     */
    public function image($path,UploadedFile $file);

    /**
     * @return mixed
     * excel上传
     */
    public function excel($path,UploadedFile $file);

    /**
     * @param $path
     * @return mixed
     * 删除文件
     */
    public function remove($path);
}