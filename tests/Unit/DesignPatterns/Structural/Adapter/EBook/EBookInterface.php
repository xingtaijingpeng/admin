<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 16:44
 */

namespace Tests\Unit\DesignPatterns\Structural\Adapter\EBook;

/**
 * EBookInterface 是电子书接口
 */
interface EBookInterface
{
    /**
     * 电子书翻页
     *
     * @return mixed
     */
    public function pressNext();

    /**
     * 打开电子书
     *
     * @return mixed
     */
    public function pressStart();
}
