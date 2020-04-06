<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 17:30
 */

namespace Tests\Unit\DesignPatterns\Structural\Bridge\Vehicle;

use Tests\Unit\DesignPatterns\Structural\Bridge\Workshop\Workshop;

/**
 * 抽象
 */
abstract class Vehicle
{

    protected $workShop1;
    protected $workShop2;

    protected function __construct(Workshop $workShop1, Workshop $workShop2)
    {
        $this->workShop1 = $workShop1;
        $this->workShop2 = $workShop2;
    }

    public function manufacture()
    {
    }
}
