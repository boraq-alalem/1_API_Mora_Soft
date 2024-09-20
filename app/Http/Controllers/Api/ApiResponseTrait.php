<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function ApiResponce($data = null, $status = null, $msg = null) {
        $arry = [
            'status'=>$status,
            'message'=>$msg,
            'data'=>$data,
        ];

        return response($arry, $status);
    }
}
