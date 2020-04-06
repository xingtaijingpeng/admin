<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 10:08
 */

namespace Tests\Unit\DesignPatterns\Creational\Builder;


use Tests\TestCase;
use Tests\Unit\DesignPatterns\Creational\Builder\Builder\BikeBuilder;
use Tests\Unit\DesignPatterns\Creational\Builder\Builder\BuilderInterface;
use Tests\Unit\DesignPatterns\Creational\Builder\Builder\CarBuilder;
use Tests\Unit\DesignPatterns\Creational\Builder\Director\Director;

class DirectorTest extends TestCase
{
    protected $director;

    protected function setUp():void
    {
        parent::setUp();
        $this->director = new Director();
    }

    public function getBuilder()
    {
        return array(
            array(new CarBuilder()),
            array(new BikeBuilder())
        );
    }

    /**
     * 这里我们测试建造过程，客户端并不知道具体的建造者。
     *
     * @dataProvider getBuilder
     */
    public function testBuild(BuilderInterface $builder)
    {
        $newVehicle = $this->director->build($builder);
        var_dump($newVehicle);
        $this->assertInstanceOf('Tests\Unit\DesignPatterns\Creational\Builder\Vehicle\Vehicle', $newVehicle);
    }
}
