<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Models\Role;

class RoleController extends ApiCrudController
{
    protected $modelClass = Role::class;
}
