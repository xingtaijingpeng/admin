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
            'created_at' => (string)$this->created_at,
        ];
    }
}
