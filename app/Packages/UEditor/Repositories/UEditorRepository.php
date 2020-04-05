<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/4
 * Time: 14:20
 */

namespace App\Packages\UEditor\Repositories;

use App\Packages\UEditor\Interfaces\UEditorInterface;
use Illuminate\Http\UploadedFile;

class UEditorRepository implements UEditorInterface
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
}
