<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ApiAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
//    public function handle(Request $request, Closure $next): Response
//    {
//        if(!Auth::check())
//            return ApiResponse::send(false, "401 You are not logged in", 401)
//        
//        return $next($request);
//    }

    protected function unauthenticated($request, array $guards)
    {
        if (!Auth::guard('sanctum')->check()){
            return abort(ApiResponse::send(false, "401 Unauthorized Access", 401));
        }
        return parent::unauthenticated($request, $guards);
    }
}
