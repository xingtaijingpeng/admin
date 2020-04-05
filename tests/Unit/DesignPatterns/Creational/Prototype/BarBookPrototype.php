<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/12
 * Time: 13:38
 */

namespace Tests\Unit\DesignPatterns\Creational\Prototype;

/**
 * BarBookPrototype类
 */
class BarBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Bar';

    /**
     * empty clone
     */
    public function __clone()
    {
    }
}
