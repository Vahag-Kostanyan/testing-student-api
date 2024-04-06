<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\admin\RoleValidationTrate;
use App\Models\Role;

class RoleController extends ApiCrudController implements ApiCrudInterface
{
    use RoleValidationTrate;
    protected $modelClass = Role::class;
}
