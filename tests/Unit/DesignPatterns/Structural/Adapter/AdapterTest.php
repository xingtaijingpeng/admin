<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 16:45
 */

namespace Tests\Unit\DesignPatterns\Structural\Adapter;

use Tests\TestCase;
use Tests\Unit\DesignPatterns\Structural\Adapter\EBook\EBookAdapter;
use Tests\Unit\DesignPatterns\Structural\Adapter\EBook\Kindle;
use Tests\Unit\DesignPatterns\Structural\Adapter\PaperBook\Book;
use Tests\Unit\DesignPatterns\Structural\Adapter\PaperBook\PaperBookInterface;

/**
 * AdapterTest 用于测试适配器模式
 */
class AdapterTest extends TestCase
{
    /**
     * @return array
     */
    public function getBook()
    {
        return array(
            array(new Book()),
            // 我们在适配器中引入了电子书
            array(new EBookAdapter(new Kindle()))
        );
    }

    /**
     * 客户端只知道有纸质书，实际上第二本书是电子书，
     * 但是对客户来说代码一致，不需要做任何改动
     *
     * @param PaperBookInterface $book
     *
     * @dataProvider getBook
     */
    public function testIAmAnOldClient(PaperBookInterface $book)
    {
        $this->assertTrue(method_exists($book, 'open'));
        $this->assertTrue(method_exists($book, 'turnPage'));
    }
}
