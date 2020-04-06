<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 13:30
 */

namespace Tests\Unit\DesignPatterns\Creational\SimpleFactory\Factory;

/**
 * ConcreteFactory类
 */
class ConcreteFactory
{
    /**
     * @var array
     */
    protected $typeList;

    /**
     * 你可以在这里注入自己的车子类型
     */
    public function __construct()
    {
        $this->typeList = array(
            'bicycle' => '\Tests\Unit\DesignPatterns\Creational\SimpleFactory\Vehicle\Bicycle',
            'other' => '\Tests\Unit\DesignPatterns\Creational\SimpleFactory\Vehicle\Scooter'
        );
    }

    /**
     * 创建车子
     *
     * @param string $type a known type key
     *
     * @return VehicleInterface a new instance of VehicleInterface
     * @throws \InvalidArgumentException
     */
    public function createVehicle($type)
    {
        if (!array_key_exists($type, $this->typeList)) {
            throw new \InvalidArgumentException("$type is not valid vehicle");
        }
        $className = $this->typeList[$type];

        return new $className();
    }
}
