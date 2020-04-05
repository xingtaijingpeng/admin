<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 6:16
 */

namespace Tests\Unit\DesignPatterns\Creational\AbstractFactory\Product\Html;

/**
 * Text 类
 *
 * 该类是以 HTML 渲染的具体文本组件类
 */
class Text extends \Tests\Unit\DesignPatterns\Creational\AbstractFactory\Media\Text
{
    /**
     * HTML 格式输出的文本
     *
     * @return string
     */
    public function render()
    {
        return '<div>' . htmlspecialchars($this->text) . '</div>';
    }
}
