<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Models\User;

class UserConntroller extends ApiCrudController implements ApiCrudInterface
{
    protected $modelClass = User::class;
}