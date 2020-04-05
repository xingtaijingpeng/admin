<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 11:04
 */

namespace Tests\Unit\DesignPatterns\Creational\FactoryMethod\Vehicle;

/**
 * VehicleInterface是车辆接口
 */
interface VehicleInterface
{
    /**
     * 设置车的颜色
     *
     * @param string $rgb
     */
    public function setColor($rgb);
}
