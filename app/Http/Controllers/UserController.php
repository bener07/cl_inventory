<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\ApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserResource($request->user());
    }

    public function login(LoginRequest $request){
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];
        if(!Auth::attempt($credentials)){
            return ApiResponse::send(false, "403 Credentials do not match our records", 403);
        }
        $user = Auth::user();
        $token = $user->issueToken();

        return ApiResponse::send(true, "Bearer ".$token, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
