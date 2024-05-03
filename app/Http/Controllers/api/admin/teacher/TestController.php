<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Models\Test;

class TestController extends ApiCrudController implements ApiCrudInterface
{
    protected $modelClass = Test::class;
    protected $searchFaild = ['id', 'name', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['type', 'user', 'user.userProfile', 'subject'];

}