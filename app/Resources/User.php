<?php

namespace App\Resources;

class User extends Base
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'mobile' => $this->mobile,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'email' => $this->email,
            'sex' => $this->sex,
            'qianming' => $this->qianming,
            'real_name' => $this->real_name,
            'real_num' => $this->real_num,
            'address' => $this->address,
            'created_at' => (string)$this->created_at,
        ];
    }
}
