<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\admin\teacher\TestQuestionsValidationTrait;
use App\Models\TestQuestion;

class TestQuestionsController extends ApiCrudController implements ApiCrudInterface
{
    use TestQuestionsValidationTrait;
    protected $modelClass = TestQuestion::class;
    protected $searchField = ['test_id', 'question_id', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['test', 'question', 'question.questionType', 'question.questionOptions', 'question.questionAnswers'];
}