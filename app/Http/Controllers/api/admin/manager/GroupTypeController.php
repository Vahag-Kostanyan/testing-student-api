<?php

namespace App\Http\Controllers\api\admin\manager;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\manager\GroupTypeValidationTrate;
use App\Models\GroupType;

class GroupTypeController extends ApiCrudController implements ApiCrudInterface
{
    use GroupTypeValidationTrate;
    protected $modelClass = GroupType::class;
}