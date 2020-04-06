<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 11:04
 */

namespace Tests\Unit\DesignPatterns\Creational\FactoryMethod;

use Tests\TestCase;
use Tests\Unit\DesignPatterns\Creational\FactoryMethod\Factory\FactoryMethod;
use Tests\Unit\DesignPatterns\Creational\FactoryMethod\Factory\GermanFactory;
use Tests\Unit\DesignPatterns\Creational\FactoryMethod\Factory\ItalianFactory;

/**
 * FactoryMethodTest用于测试工厂方法模式
 */
class FactoryMethodTest extends TestCase
{

    protected $type = array(
        FactoryMethod::CHEAP,
        FactoryMethod::FAST
    );

    public function getShop()
    {
        return array(
            array(new GermanFactory()),
            array(new ItalianFactory())
        );
    }

    /**
     * @dataProvider getShop
     */
    public function testCreation(FactoryMethod $shop)
    {
        // 该方法扮演客户端角色，我们不关心什么工厂，我们只知道可以可以用它来造车
        foreach ($this->type as $oneType) {
            $vehicle = $shop->create($oneType);
            $this->assertInstanceOf('Tests\Unit\DesignPatterns\Creational\FactoryMethod\Vehicle\VehicleInterface', $vehicle);
        }
    }

    /**
     * @dataProvider getShop
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage spaceship is not a valid vehicle
     */
    public function testUnknownType(FactoryMethod $shop)
    {
        try{
            $shop->create('spaceship');
        }catch (\InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
