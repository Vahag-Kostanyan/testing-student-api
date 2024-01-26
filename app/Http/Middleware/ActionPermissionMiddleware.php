<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
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
        $except = ['api/getme', 'api/login'];

        $role = auth()->user()->load('role')->role;

        
        if($role->name === "superAdmin" || in_array(request()->path(), $except)){
            return $next($request);
        }

        $permissions = $role->load('rolePermission.permission')->rolePermission;

        $route = substr(request()->path(), 3);

        foreach($permissions as $permission){
            if($permission->permission->page === $route){
                $access = array_map('intval', str_split($permission->permission->permission));
                
                switch(request()->method()){
                    case 'GET':
                        if($access[1] == 1){
                            return $next($request);
                        }
                    case 'POST':
                        if($access[0] == 1){
                            return $next($request);
                        }
                    case 'PUT':
                        if($access[2] == 1){
                            return $next($request);
                        }
                    case 'PUTCH':
                        if($access[2] == 1){
                            return $next($request);
                        }
                    case 'DELETE':
                        if($access[3] == 1){
                            return $next($request);
                        }
                }
            }
        }

        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Permission dinide',
        ], 403));
    }
}
