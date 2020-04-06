<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 11:03
 */

namespace Tests\Unit\DesignPatterns\Creational\FactoryMethod\Factory;


use Tests\Unit\DesignPatterns\Creational\FactoryMethod\Vehicle\Bicycle;
use Tests\Unit\DesignPatterns\Creational\FactoryMethod\Vehicle\Ferrari;

/**
 * ItalianFactory是意大利的造车厂
 */
class ItalianFactory extends FactoryMethod
{
    /**
     * {@inheritdoc}
     */
    protected function createVehicle($type)
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
                break;
            case parent::FAST:
                return new Ferrari();
                break;
            default:
                throw new \InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}
