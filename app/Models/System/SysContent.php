<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/6
 * Time: 10:30
 */

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class SysContent extends Model
{
    /**
     * Get all of the owning commentable models.
     */
    public function model()
    {
        return $this->morphTo();
    }
}
