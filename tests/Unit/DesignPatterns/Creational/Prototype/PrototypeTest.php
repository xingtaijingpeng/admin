<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 13:39
 */

namespace Tests\Unit\DesignPatterns\Creational\Prototype;

use Tests\TestCase;

/**
 * PrototypeTest tests the prototype pattern
 */
class PrototypeTest extends TestCase
{

    public function getPrototype(){
        return array(
            array(new FooBookPrototype()),
            array(new BarBookPrototype())
        );
    }

    /**
     * @dataProvider getPrototype
     */
    public function testCreation(BookPrototype $prototype)
    {
        $book = clone $prototype;
        $book->setTitle($book->getCategory().' Book');

        $this->assertInstanceOf('Tests\Unit\DesignPatterns\Creational\Prototype\BookPrototype', $book);
    }
}
