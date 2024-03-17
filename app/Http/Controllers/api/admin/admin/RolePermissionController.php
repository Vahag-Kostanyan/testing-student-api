<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Models\RolePermission;

class RolePermissionController extends ApiCrudController implements ApiCrudInterface
{
    protected $modelClass = RolePermission::class;
}
