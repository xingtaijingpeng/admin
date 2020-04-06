<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 6:09
 */

namespace Tests\Unit\DesignPatterns\Creational\AbstractFactory\Factory;

use Tests\Unit\DesignPatterns\Creational\AbstractFactory\Product\Html\Picture;
use Tests\Unit\DesignPatterns\Creational\AbstractFactory\Product\Html\Text;

/**
 * HtmlFactory类
 *
 * HtmlFactory 是用于创建 HTML 组件的工厂
 */
class HtmlFactory extends AbstractFactory
{
    /**
     * 创建图片组件
     *
     * @param string $path
     * @param string $name
     *
     * @return Html\Picture|Picture
     */
    public function createPicture($path, $name = '')
    {
        return new Picture($path, $name);
    }

    /**
     * 创建文本组件
     *
     * @param string $content
     *
     * @return Html\Text|Text
     */
    public function createText($content)
    {
        return new Text($content);
    }
}
