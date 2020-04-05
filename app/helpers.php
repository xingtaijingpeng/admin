<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/11/12
 * Time: 15:36
 */

/**
 * 根据二维数组某字段排序
 */
if(!function_exists('sort_vaule'))
{
    function sort_vaule($data,$column,$sort = SORT_DESC)
    {
        $last_names = array_column($data,$column);
        array_multisort($last_names,$sort,$data);
        return $data;
    }
}

