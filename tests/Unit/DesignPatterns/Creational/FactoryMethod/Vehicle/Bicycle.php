<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 11:04
 */

namespace Tests\Unit\DesignPatterns\Creational\FactoryMethod\Vehicle;

/**
 * Bicycle（自行车）
 */
class Bicycle implements VehicleInterface
{
    /**
     * @var string
     */
    protected $color;

    /**
     * 设置自行车的颜色
     *
     * @param string $rgb
     */
    public function setColor($rgb)
    {
        $this->color = $rgb;
    }
}
