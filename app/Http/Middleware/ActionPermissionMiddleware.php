<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ActionPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = auth()->user()->load('role')->role;
        
        $route = substr(request()->path(), 3);

        if(hasPermission($role->id, $route)) return $next($request);

        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Permission dinide',
        ], 403));
    }
}
