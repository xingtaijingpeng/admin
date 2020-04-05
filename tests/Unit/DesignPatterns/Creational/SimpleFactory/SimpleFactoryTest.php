<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 13:30
 */

namespace Tests\Unit\DesignPatterns\Creational\SimpleFactory;

use Tests\TestCase;
use Tests\Unit\DesignPatterns\Creational\SimpleFactory\Factory\ConcreteFactory;

/**
 * SimpleFactoryTest 用于测试简单工厂模式
 */
class SimpleFactoryTest extends TestCase
{

    protected $factory;

    protected function setUp():void
    {
        parent::setUp();
        $this->factory = new ConcreteFactory();
    }

    public function getType()
    {
        return array(
            array('bicycle'),
            array('other')
        );
    }

    /**
     * @dataProvider getType
     */
    public function testCreation($type)
    {
        $obj = $this->factory->createVehicle($type);
        $this->assertInstanceOf('Tests\Unit\DesignPatterns\Creational\SimpleFactory\Vehicle\VehicleInterface', $obj);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBadType()
    {
        try{
            $this->factory->createVehicle('car');
        }catch (\InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
