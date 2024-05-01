<?php

namespace App\Repositories\api\admin\admin\rolePermission;

use App\Http\Requests\api\admin\admin\RolePermissionRequest;
use App\Models\RolePermission;


class RolePermissionRepository implements RolePermissionRepositoryInterface
{

    /**
     * @param RolePermissionRequest $request
     * @return array
     */
    public function creadAndUpdate(RolePermissionRequest $request): array
    {
        $existsPermissionIds = array_column(RolePermission::where('role_id', $request->role_id)->whereIn('permission_id', $request->permission_ids)->select('permission_id')->get()->toArray(), 'permission_id');
        $rolePermissionsForDelete = RolePermission::where('role_id', $request->role_id)->whereNotIn('permission_id', $request->permission_ids)->get();

        foreach ($rolePermissionsForDelete as $rolePermission) $rolePermission->delete(); 

        foreach ($request->permission_ids as $permission_id) {
            if (!in_array($permission_id, $existsPermissionIds)) {
                RolePermission::create(
                    [
                        'role_id' => $request->role_id,
                        'permission_id' => $permission_id,
                    ]
                );
            }
        }

        return [
            'status' => true,
            'message' => 'Permissions for role saved successfully',
        ];
    }
}