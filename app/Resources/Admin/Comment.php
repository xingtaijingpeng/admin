<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2020/4/17
 * Time: 16:42
 */

namespace App\Resources\Admin;

use App\Resources\Base;

class Comment extends Base
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'contents' => $this->contents,
			'cover' => $this->cover,
			'created_at' => (string)$this->created_at
		];
	}
}
