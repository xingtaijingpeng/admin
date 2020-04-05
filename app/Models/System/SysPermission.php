<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 21:04
 */

namespace App\Models\System;

use Spatie\Permission\Models\Permission;

class SysPermission extends Permission
{
    const IS_WORK = 1;
    const NOT_WORK = 2;

    const IS_MENU = 1;
    const NOT_MENU = 2;
}