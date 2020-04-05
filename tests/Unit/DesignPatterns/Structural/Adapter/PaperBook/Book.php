<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 16:44
 */

namespace Tests\Unit\DesignPatterns\Structural\Adapter\PaperBook;


/**
 * Book 是纸质书实现类
 */
class Book implements PaperBookInterface
{
    /**
     * {@inheritdoc}
     */
    public function open()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function turnPage()
    {
    }
}
