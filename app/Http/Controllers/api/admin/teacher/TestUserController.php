<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\teacher\TestUserValidationTrate;
use App\Models\UserTest;

class TestUserController extends ApiCrudController implements ApiCrudInterface
{
    use TestUserValidationTrate;
    protected $modelClass = UserTest::class;
}