<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 9:55
 */

namespace Tests\Unit\DesignPatterns\Creational\Builder\Vehicle;

/**
 * VehicleInterface是车辆接口
 */
abstract class Vehicle
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
    }
}
