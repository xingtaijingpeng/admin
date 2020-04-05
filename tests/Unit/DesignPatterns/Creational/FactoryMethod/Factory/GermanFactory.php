<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 11:03
 */

namespace Tests\Unit\DesignPatterns\Creational\FactoryMethod\Factory;

use Tests\Unit\DesignPatterns\Creational\FactoryMethod\Vehicle\Bicycle;
use Tests\Unit\DesignPatterns\Creational\FactoryMethod\Vehicle\Porsche;

/**
 * GermanFactory是德国的造车厂
 */
class GermanFactory extends FactoryMethod
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
                $obj = new Porsche();
                //因为我们已经知道是什么对象所以可以调用具体方法
                $obj->addTuningAMG();

                return $obj;
                break;
            default:
                throw new \InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}
