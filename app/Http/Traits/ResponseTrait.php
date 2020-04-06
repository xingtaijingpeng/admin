<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/29/029
 * Time: 14:50
 */

namespace App\Http\Traits;


use App\Resources\Base;

trait ResponseTrait
{
    /**
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * 成功返回
     */
    protected function success($message, $data=[])
    {
        return $this->toResponseData($message, 1,$data);
    }

    /**
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * 失败返回
     */
    protected function error($message, $data=[])
    {
        return $this->toResponseData($message, 0,$data);
    }


    /**
     * @param $message
     * @param $status
     * @param array $data
     * @return mixed
     * 公用返回
     */
    private function toResponseData($message, $status, $data=[])
    {
        return response()->json($message == 'only' ? $data : ['data' => $data, 'status' => $status, 'message' => $message,])->setCallback(request()->input('callback'));
    }
}
