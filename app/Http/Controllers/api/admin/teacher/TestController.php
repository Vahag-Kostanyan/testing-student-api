<?php

namespace App\Http\Controllers\api\admin\teacher;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\admin\teacher\TestValidationTrait;
use App\Models\Test;

class TestController extends ApiCrudController implements ApiCrudInterface
{
    use TestValidationTrait;
    protected $modelClass = Test::class;
    protected $searchField = ['id', 'name', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['type', 'user', 'testUsers', 'testUsers.user', 'testUsers.user.userProfile', 'user.userProfile', 'subject', 'testQuestions', 'testQuestions.question'];
}