<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 13:40
 */

namespace Tests\Unit\DesignPatterns\Creational\StaticFactory;

use Tests\TestCase;
use Tests\Unit\DesignPatterns\Creational\StaticFactory\Factory\StaticFactory;

class StaticFactoryTest extends TestCase
{
    public function getTypeList()
    {
        return array(
            array('string'),
            array('number')
        );
    }

    /**
     * @dataProvider getTypeList
     */
    public function testCreation($type)
    {
        $obj = StaticFactory::factory($type);
        $this->assertInstanceOf('Tests\Unit\DesignPatterns\Creational\StaticFactory\Format\FormatterInterface', $obj);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testException()
    {
        try{
            StaticFactory::factory("");
        }catch (\InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
