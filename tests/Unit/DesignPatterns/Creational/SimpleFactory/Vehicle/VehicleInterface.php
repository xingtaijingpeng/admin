<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 13:30
 */

namespace Tests\Unit\DesignPatterns\Creational\SimpleFactory\Vehicle;

/**
 * VehicleInterface 是车子接口
 */
interface VehicleInterface
{
    /**
     * @param mixed $destination
     *
     * @return mixed
     */
    public function driveTo($destination);
}
