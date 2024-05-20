<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\admin\teacher\TestQuestionRequest;
use App\Http\Requests\api\ValidationTrait\admin\teacher\TestValidationTrait;
use App\Models\Test;
use App\Repositories\api\admin\teacher\test\TestRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\JsonResponse;

class TestController extends ApiCrudController implements ApiCrudInterface
{
    use TestValidationTrait;
    protected $modelClass = Test::class;
    protected $searchField = ['id', 'name', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['type', 'user', 'testUsers', 'user.userProfile', 'subject'];


    /**
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     * @param TestRepositoryInterface $testRepository
     * @inheritDoc
     */
    public function __construct(ApiCrudRepositoryInterface $apiCrudRepository, private TestRepositoryInterface $testRepository){
        parent::__construct($apiCrudRepository);
    }

     /**
     * @param TestQuestionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateTestQuestions(TestQuestionRequest $request, int $id) : JsonResponse
    {
        $request->after_validation($id);
        return response()->json($this->testRepository->updateTestQuestions($request, $id), 200);
    }
}