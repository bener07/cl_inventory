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

    public static function send(bool $success, $message, int $code, $datatables=false){
        // se for um pedido vindo do frontend, muito provavelmente é feito em datatables
        if($datatables){
            return response()->json($message);
        }
        return response()->json([
            "success" => $success,
            "content" => $message,
            "code" => $code,
        ], 200);
    }
}
