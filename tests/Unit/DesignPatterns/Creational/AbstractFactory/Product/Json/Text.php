<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 6:14
 */

namespace Tests\Unit\DesignPatterns\Creational\AbstractFactory\Product\Json;

/**
 * Class Text
 *
 * 该类是以 JSON 格式输出的具体文本组件类
 */
class Text extends \Tests\Unit\DesignPatterns\Creational\AbstractFactory\Media\Text
{
    /**
     * 以 JSON 格式输出的渲染
     *
     * @return string
     */
    public function render()
    {
        return json_encode(array('content' => $this->text));
    }
}
