<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 13:30
 */

namespace Tests\Unit\DesignPatterns\Creational\Singleton;

use Tests\TestCase;

/**
 * SingletonTest用于测试单例模式
 */
class SingletonTest extends TestCase
{

    public function testUniqueness()
    {
        $firstCall = Singleton::getInstance();
        $this->assertInstanceOf('Tests\Unit\DesignPatterns\Creational\Singleton\Singleton', $firstCall);
        $secondCall = Singleton::getInstance();
        $this->assertSame($firstCall, $secondCall);
    }

    public function testNoConstructor()
    {
        $obj = Singleton::getInstance();

        $refl = new \ReflectionObject($obj);
        $meth = $refl->getMethod('__construct');
        $this->assertTrue($meth->isPrivate());
    }
}
