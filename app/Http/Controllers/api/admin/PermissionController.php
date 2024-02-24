<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Models\Permission;

class PermissionController extends ApiCrudController
{
    protected $modelClass = Permission::class;
}
