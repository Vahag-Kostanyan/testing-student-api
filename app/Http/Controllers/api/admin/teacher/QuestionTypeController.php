<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Models\QuestionType;

class QuestionTypeController extends ApiCrudController implements ApiCrudInterface
{
    protected $modelClass = QuestionType::class;
    protected $searchField = ['id', 'name', 'description', 'created_at', 'updated_at'];
}