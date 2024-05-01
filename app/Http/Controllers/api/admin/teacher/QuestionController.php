<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\teacher\QuestionValidationTrate;
use App\Models\Question;
use App\Repositories\api\admin\teacher\question\QuestionRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;

class QuestionController extends ApiCrudController implements ApiCrudInterface
{
    use QuestionValidationTrate;
    protected $modelClass = Question::class;
    protected $searchFaild = ['id', 'title', 'point', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['questionType', 'questionOptions', 'questionAnswers'];

    /**
     * @param QuestionRepositoryInterface $questionRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(ApiCrudRepositoryInterface $apiCrudRepository, private QuestionRepositoryInterface $questionRepository)
    {
        parent::__construct($apiCrudRepository);
        $this->storeRepository = $this->questionRepository;
        $this->updateRepository = $this->questionRepository;
    }
}