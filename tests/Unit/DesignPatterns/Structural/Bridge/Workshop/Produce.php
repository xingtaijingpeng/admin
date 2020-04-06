<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 17:30
 */

namespace Tests\Unit\DesignPatterns\Structural\Bridge\Workshop;

/**
 * 具体实现：Produce
 */
class Produce implements Workshop
{

    public function work()
    {
        print 'Produced ';
    }
}
