<?php

use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\SubPermission;

/**
 * @param int $role_id
 * @param string $route
 * @return bool
 */

function hasPermission(int $role_id, string $route): bool
{
 
    $route = convertRoute($route);

    $methods = ['GET' => 'read', 'POST' => 'create', 'PUT' => 'update', 'PATCH' => 'update', 'DELETE' => 'delete'];

    $permission_id = Permission::where('page', $route)->where('method', $methods[request()->method()])->first()->id;
    
    if(!$permission_id){
        $permission_id = SubPermission::where('page', $route)->where('method', $methods[request()->method()])->first();

        if(!$permission_id) return false;
    }

    $role_permission = RolePermission::where('role_id', $role_id)->where('permission_id', $permission_id)->first();
    
    if($role_permission) return true;
    
    return false;
}

function convertRoute(string $route) : string
{
    if(request()->method() == 'PUT' || request()->method() == 'PATCH' || request()->method() == 'GET'){
        $routeArray = explode('/', ltrim($route, '/'));
        $route = '';
        foreach($routeArray as $item){
            if(is_numeric($item)){
                if(request()->method() == 'GET'){
                    $route .= '/' . ':id';
                }
            }else{
                $route .= '/' . $item;
            }
        }
    }

    return $route;
}