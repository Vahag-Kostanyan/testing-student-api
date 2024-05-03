<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Models\TestType;

class TestTypeController extends ApiCrudController implements ApiCrudInterface
{
    protected $modelClass = TestType::class;
    protected $searchFaild = ['id', 'name', 'description', 'created_at', 'updated_at'];
}