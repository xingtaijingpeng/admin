<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 9:55
 */

namespace Tests\Unit\DesignPatterns\Creational\Builder\Builder;

use Tests\Unit\DesignPatterns\Creational\Builder\Parts\Door;
use Tests\Unit\DesignPatterns\Creational\Builder\Parts\Engine;
use Tests\Unit\DesignPatterns\Creational\Builder\Parts\Wheel;
use Tests\Unit\DesignPatterns\Creational\Builder\Vehicle\Car;

/**
 * CarBuilder用于建造汽车
 */
class CarBuilder implements BuilderInterface
{
    /**
     * @var Parts\Car
     */
    protected $car;

    /**
     * @return void
     */
    public function addDoors()
    {
        $this->car->setPart('rightdoor', new Door());
        $this->car->setPart('leftDoor', new Door());
    }

    /**
     * @return void
     */
    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }

    /**
     * @return void
     */
    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Wheel());
        $this->car->setPart('wheelRF', new Wheel());
        $this->car->setPart('wheelLR', new Wheel());
        $this->car->setPart('wheelRR', new Wheel());
    }

    /**
     * @return void
     */
    public function createVehicle()
    {
        $this->car = new Car();
    }

    /**
     * @return Parts\Car
     */
    public function getVehicle()
    {
        return $this->car;
    }
}
