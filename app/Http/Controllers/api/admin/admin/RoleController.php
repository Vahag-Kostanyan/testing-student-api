<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\admin\admin\RoleValidationTrait;
use App\Models\Role;

class RoleController extends ApiCrudController implements ApiCrudInterface
{
    use RoleValidationTrait;
    protected $modelClass = Role::class;
    protected $allowedIncludes = ['rolePermissions', 'rolePermissions.permission'];
    protected $searchField = ['id', 'name', 'created_at', 'updated_at'];
}
