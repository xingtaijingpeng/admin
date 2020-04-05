<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseTrait;

    public function pagesize(){
        return request()->pageSize ?? 15;
    }

    public function exception(callable $call, $db = false){
        try {
            $db && DB::beginTransaction();
            $back = call_user_func($call);
            $db && DB::commit();
            return $back;
        }catch (\Exception $ex) {
            $db && DB::rollBack();
            info(__CLASS__ . ' | ' . __FUNCTION__ . ' | ' . $ex->getFile() . ' | ' . $ex->getLine() . ' | error = ' . $ex->getMessage());
            return $this->error($ex->getMessage());
        }
    }
}
