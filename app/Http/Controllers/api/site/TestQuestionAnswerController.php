<?php

namespace App\Http\Controllers\api\site;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\site\UserTestQuestionsValidationTrait;
use App\Models\TestQuestionAnswer;
use App\Repositories\api\site\testQuestionAnswer\TestQuestionAnswerRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;

class TestQuestionAnswerController extends ApiCrudController implements ApiCrudInterface
{
    use UserTestQuestionsValidationTrait;
    protected $modelClass = TestQuestionAnswer::class;

    public function __construct(ApiCrudRepositoryInterface $apiCrudRepository, TestQuestionAnswerRepositoryInterface  $testQuestionAnswerRepository){
        parent::__construct($apiCrudRepository);
        $this->indexRepository = $testQuestionAnswerRepository;
    }
}
