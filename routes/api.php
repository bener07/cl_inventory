<?php

use App\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PlaceController;

Route::post("/login", [UserController::class, 'login']);

Route::middleware(["api.auth"])->group(function () {
    Route::get("/user", function (Request $request){
        return $request->user()->id;
    });

    Route::apiResource('/items', ItemsController::class);
    Route::apiResource('/places', PlaceController::class);
});

Route::fallback(function(){
    return ApiResponse::send(false, "404 Page not found", 404);
});