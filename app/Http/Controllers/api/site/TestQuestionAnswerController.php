<?php

namespace App\Http\Controllers\api\site;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\site\UserTestQuestionsValidationTrait;
use App\Models\TestQuestionAnswer;

class TestQuestionAnswerController extends ApiCrudController implements ApiCrudInterface
{
    use UserTestQuestionsValidationTrait;
    protected $modelClass = TestQuestionAnswer::class;
}
