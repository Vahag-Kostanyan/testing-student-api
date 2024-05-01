<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\admin\admin\RolePermissionRequest;
use App\Repositories\api\admin\admin\rolePermission\RolePermissionRepositoryInterface;
use Illuminate\Http\JsonResponse;

class RolePermissionController extends Controller
{
    /**
     * @param RolePermissionRepositoryInterface $rolePermissionRepository
     */
    public function __construct(private RolePermissionRepositoryInterface $rolePermissionRepository){}
    
    /**
     * @param RolePermissionRequest $request
     * @return JsonResponse
     */
    public function creadAndUpdate(RolePermissionRequest $request) : JsonResponse
    {
        return response()->json($this->rolePermissionRepository->creadAndUpdate($request), 200);
    }
}
