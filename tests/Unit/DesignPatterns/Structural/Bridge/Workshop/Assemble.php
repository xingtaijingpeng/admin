<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 17:29
 */

namespace Tests\Unit\DesignPatterns\Structural\Bridge\Workshop;

/**
 * 具体实现：Assemble
 */
class Assemble implements Workshop
{

    public function work()
    {
        print 'Assembled';
    }
}
