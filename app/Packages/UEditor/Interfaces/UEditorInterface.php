<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/4
 * Time: 14:20
 */

namespace App\Packages\UEditor\Interfaces;

use Illuminate\Http\UploadedFile;

interface UEditorInterface
{

    /**
     * @return mixed
     * 图片上传
     */
    public function image($path,UploadedFile $file);

}
