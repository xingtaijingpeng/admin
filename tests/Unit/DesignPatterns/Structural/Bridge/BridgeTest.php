<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 17:30
 */

namespace Tests\Unit\DesignPatterns\Structural\Bridge;

use Tests\TestCase;
use Tests\Unit\DesignPatterns\Structural\Bridge\Vehicle\Car;
use Tests\Unit\DesignPatterns\Structural\Bridge\Vehicle\Motorcycle;
use Tests\Unit\DesignPatterns\Structural\Bridge\Workshop\Assemble;
use Tests\Unit\DesignPatterns\Structural\Bridge\Workshop\Produce;

class BridgeTest extends TestCase
{

    public function testCar()
    {
        $vehicle = new Car(new Produce(), new Assemble());
        $this->expectOutputString('Car Produced Assembled');
        $vehicle->manufacture();
    }

    public function testMotorcycle()
    {
        $vehicle = new Motorcycle(new Produce(), new Assemble());
        $this->expectOutputString('Motorcycle Produced Assembled');
        $vehicle->manufacture();
    }
}
