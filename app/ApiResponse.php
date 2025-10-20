<?php

namespace App;

use Illuminate\Http\Request;

class ApiResponse
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function send(bool $success, $message, int $code){
        return response()->json([
            "success" => $success,
            "content" => $message,
            "code" => $code,
        ], 401);
    }
}
