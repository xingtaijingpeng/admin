<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/11
 * Time: 6:13
 */

namespace Tests\Unit\DesignPatterns\Creational\AbstractFactory\Product\Json;

/**
 * Picture类
 *
 * 该类是以 JSON 格式输出的具体图片组件类
 */
class Picture extends \Tests\Unit\DesignPatterns\Creational\AbstractFactory\Media\Picture
{
    /**
     * JSON 格式输出
     *
     * @return string
     */
    public function render()
    {
        return json_encode(array('title' => $this->name, 'path' => $this->path));
    }
}
