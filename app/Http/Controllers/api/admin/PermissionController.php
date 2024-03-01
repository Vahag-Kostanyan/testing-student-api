<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Models\Permission;

class PermissionController extends ApiCrudController implements ApiCrudInterface
{
    protected $modelClass = Permission::class;
}
