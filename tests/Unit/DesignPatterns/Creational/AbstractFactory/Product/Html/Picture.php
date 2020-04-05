<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 6:15
 */

namespace Tests\Unit\DesignPatterns\Creational\AbstractFactory\Product\Html;


/**
 * Picture 类
 *
 * 该类是以 HTML 格式渲染的具体图片类
 */
class Picture extends \Tests\Unit\DesignPatterns\Creational\AbstractFactory\Media\Picture
{
    /**
     * HTML 格式输出的图片
     *
     * @return string
     */
    public function render()
    {
        return sprintf('<img src="%s" title="%s"/>', $this->path, $this->name);
    }
}
