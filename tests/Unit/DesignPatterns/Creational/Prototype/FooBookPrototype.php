<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 13:39
 */

namespace Tests\Unit\DesignPatterns\Creational\Prototype;

/**
 * FooBookPrototype类
 */
class FooBookPrototype extends BookPrototype
{
    protected $category = 'Foo';

    /**
     * empty clone
     */
    public function __clone()
    {
    }
}
