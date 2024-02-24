<?php

namespace App\Helper;

use App\Models\RolePermission;
use Illuminate\Database\Eloquent\Collection;

/**
 * @param Collection $permissions
 * @param string $route
 * @return bool
 */

function hasPermission(Collection $permissions, string $route) : bool
{
    foreach($permissions as $permission){
        if($permission->permission->page === $route){
            $access = array_map('intval', str_split($permission->permission->permission));
            
            switch(request()->method()){
                case 'GET':
                    if($access[1] == 1){
                        return true;
                    }
                case 'POST':
                    if($access[0] == 1){
                        return true;
                    }
                case 'PUT':
                    if($access[2] == 1){
                        return true;
                    }
                case 'PUTCH':
                    if($access[2] == 1){
                        return true;
                    }
                case 'DELETE':
                    if($access[3] == 1){
                        return true;
                    }
            }
        }
    }

    return false;
}