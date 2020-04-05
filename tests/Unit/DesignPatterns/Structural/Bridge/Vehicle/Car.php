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
 * 经过改良的抽象实现：Car
 */
class Car extends Vehicle
{

    public function __construct(Workshop $workShop1, Workshop $workShop2)
    {
        parent::__construct($workShop1, $workShop2);
    }

    public function manufacture()
    {
        print 'Car ';
        $this->workShop1->work();
        $this->workShop2->work();
    }
}
