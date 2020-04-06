<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 14:32
 */

namespace Tests\Unit\DesignPatterns\Creational\Pool;

use Tests\TestCase;

class PoolTest extends TestCase
{
    public function testPool()
    {
        $pool = new Pool('Tests\Unit\DesignPatterns\Creational\Pool\TestWorker');

        $worker = $pool->get();

        $this->assertEquals(1, $worker->id);

        $worker->id = 5;
        $pool->dispose($worker);

        $this->assertEquals(5, $pool->get()->id);
        $this->assertEquals(1, $pool->get()->id);
    }
}
