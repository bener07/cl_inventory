<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\

Route::post("login", [UserController::class, 'login']);

Route::middleware(["auth:sanctum"])->group(function () {
    Route::get("/user", function (Request $request){
        return $request->user()->id;
    });
});

Route::fallback(function(){
    return response()->json([
        "sucess"=>false,
        "message" => "404 Not found",
        "code" => 404,
    ], 404);
});