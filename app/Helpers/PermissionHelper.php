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

    $permission = Permission::where('page', $route)->where('method', $methods[request()->method()])->first();

    if (!$permission) {
        $subPermission = SubPermission::where('page', $route)->where('method', $methods[request()->method()])->first();

        if (!$subPermission)
            return false;

        $permission = Permission::find($subPermission->permission_id);
    }

    $role_permission = RolePermission::where('role_id', $role_id)->where('permission_id', $permission->id)->first();

    if ($role_permission)
        return true;

    return false;
}

/**
 * @param string $route
 * @return string
 */
function convertRoute(string $route): string
{
    if (request()->method() == 'PUT' || request()->method() == 'PATCH' || request()->method() == 'DELETE' || request()->method() == 'GET') {
        $routeArray = explode('/', ltrim($route, '/'));
        $route = '';
        foreach ($routeArray as $item) {
            if (!is_numeric($item)) {
                $route .= '/' . $item;
            }
            // if (is_numeric($item)) {
            //     if (request()->method() == 'GET') {
            //         $route .= '/' . ':id';
            //     }
            // } else {
            //     $route .= '/' . $item;
            // }
        }
    }

    return $route;
}


/**
 * @return array
 */
function getUserPermissions() : array
{
    $rolePermissions = auth()->user()->load('role.rolePermissions')->role->rolePermissions;

    $permissions_ids = [];

    foreach($rolePermissions as $rolePermission)
    {
        $permissions_ids[] = $rolePermission->permission_id;
    }

    $permissionsList = Permission::select(['title', 'type', 'page', 'method'])->whereIn('id', $permissions_ids)->get()->groupBy('page')->toArray();

    $permissions = [];

    foreach($permissionsList as $permissionList)
    {
        $methodArray = [];

        foreach($permissionList as $item){
            $methodArray[] = $item['method']; 
        }

        $permissionList[0]['method'] = $methodArray;
        $permissions[] = $permissionList[0];
    }

    return $permissions;
}