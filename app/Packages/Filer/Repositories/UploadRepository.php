<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2020-03-31
 * Time: 10:59
 */

namespace App\Packages\Filer\Repositories;

use App\Packages\Filer\Interfaces\UploadInterface;
use Illuminate\Http\UploadedFile;

class UploadRepository implements UploadInterface
{
    /**
     * @return mixed
     * 图片上传
     */
    public function image($path, UploadedFile $file)
    {
        $ext = $file->getClientOriginalExtension();
        $fileUniqName = uniqid() . '.' . $ext;

        return (string)$file->move($path,$fileUniqName);
    }

    /**
     * @return mixed
     * excel上传
     */
    public function excel($path, UploadedFile $file)
    {
        // TODO: Implement excel() method.
    }

    /**
     * @param $path
     * @return mixed
     * 删除文件
     */
    public function remove($path)
    {
        // TODO: Implement deleteFile() method.
    }
}
