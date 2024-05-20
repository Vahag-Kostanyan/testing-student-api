<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\admin\teacher\TestUserValidationTrait;
use App\Models\UserTest;

class TestUserController extends ApiCrudController implements ApiCrudInterface
{
    use TestUserValidationTrait;
    protected $modelClass = UserTest::class;
}