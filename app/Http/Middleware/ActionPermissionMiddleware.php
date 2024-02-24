<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function App\Helper\hasPermission;

class ActionPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $except = ['api/getme', 'api/login'];

        $role = auth()->user()->load('role')->role;
        
        if($role->name === "superAdmin" || in_array(request()->path(), $except)){
            return $next($request);
        }

        $permissions = $role->load('rolePermission.permission')->rolePermission;

        $route = substr(request()->path(), 3);

        if(hasPermission($permissions, $route)) return $next();

        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Permission dinide',
        ], 403));
    }
}
