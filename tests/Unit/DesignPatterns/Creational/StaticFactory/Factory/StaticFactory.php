<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/12/11
 * Time: 13:39
 */

namespace Tests\Unit\DesignPatterns\Creational\StaticFactory\Factory;

class StaticFactory
{
    /**
     * 通过传入参数创建相应对象实例
     *
     * @param string $type
     *
     * @static
     *
     * @throws \InvalidArgumentException
     * @return FormatterInterface
     */
    public static function factory($type)
    {
        $className = '\Tests\Unit\DesignPatterns\Creational\StaticFactory\Format\Format' . ucfirst($type);

        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Missing format class.');
        }

        return new $className();
    }
}
