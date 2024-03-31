<?php

namespace App\Repositories\api\admin\admin\rolePermission;
use App\Http\Requests\api\admin\admin\RolePermissionRequest;


interface RolePermissionRepositoryInterface 
{
    /**
     * @param RolePermissionRequest $request
     * @return array
     */
    public function creadAndUpdate(RolePermissionRequest $request) : array;
}