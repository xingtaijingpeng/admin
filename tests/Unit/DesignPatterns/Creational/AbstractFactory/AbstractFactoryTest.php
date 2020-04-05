<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 6:16
 */

namespace Tests\Unit\DesignPatterns\Creational\AbstractFactory;

use Tests\TestCase;
use Tests\Unit\DesignPatterns\Creational\AbstractFactory\Factory\AbstractFactory;
use Tests\Unit\DesignPatterns\Creational\AbstractFactory\Factory\HtmlFactory;
use Tests\Unit\DesignPatterns\Creational\AbstractFactory\Factory\JsonFactory;

/**
 * AbstractFactoryTest 用于测试具体的工厂
 */
class AbstractFactoryTest extends TestCase
{
    public function getFactories()
    {
        return array(
            array(new JsonFactory()),
            array(new HtmlFactory())
        );
    }

    /**
     * 这里是工厂的客户端，我们无需关心传递过来的是什么工厂类，
     * 只需以我们想要的方式渲染任意想要的组件即可。
     *
     * @dataProvider getFactories
     */
    public function testComponentCreation(AbstractFactory $factory)
    {
        $article = array(
            $factory->createText('Laravel学院'),
            $factory->createPicture('/image.jpg', 'laravel-academy'),
            $factory->createText('LaravelAcademy.org')
        );

        print_r($article);
        $this->assertContainsOnly('Tests\Unit\DesignPatterns\Creational\AbstractFactory\Media\MediaInterface', $article);
    }
}
