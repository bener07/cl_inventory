<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ApiAuthentication extends Middleware
{

    protected function redirectTo(Request $request): ?string
    {
        // If the request expects JSON, return null so it doesn’t redirect
        if ($request->expectsJson() || $request->is('api/*')) {
            return null;
        }

        // Otherwise fallback for web routes
        return route('login');
    }

    protected function unauthenticated($request, array $guards)
    {
        // Custom response for API
        if ($request->expectsJson() || $request->is('api/*')) {
            abort(response()->json([
                'status' => 'error',
                'message' => 'Authentication required. Please log in or provide a valid token. Login trough /api/login',
                'code' => 401,
            ], 401));
        }

        parent::unauthenticated($request, $guards);
    }

}
