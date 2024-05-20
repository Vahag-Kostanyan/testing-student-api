<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\Api\admin\teacher\TestQuestionRequest;
use App\Http\Requests\api\ValidationTrate\admin\teacher\TestValidationTrate;
use App\Models\Test;
use App\Repositories\Api\Admin\teacher\test\TestRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\JsonResponse;

class TestController extends ApiCrudController implements ApiCrudInterface
{
    use TestValidationTrate;
    protected $modelClass = Test::class;
    protected $searchFaild = ['id', 'name', 'created_at', 'updated_at'];
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