<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' =>$code
        ],);
    }

    public function errorResponse($message, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'status' =>$code
        ],);
    }
}
