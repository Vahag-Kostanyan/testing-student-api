<?php

namespace App\Http\Controllers\api\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\site\TestQuestionsRequest;
use App\Repositories\api\site\test\TestRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @param TestRepositoryInterface $testRepository
     * @inheritDoc
     */
    public function __construct(private TestRepositoryInterface $testRepository) {}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getTests(Request $request) : JsonResponse
    {
        return response()->json($this->testRepository->getStudentTest($request), 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function getTestQuestions(TestQuestionsRequest $request, int|string $id) : JsonResponse
    {
        $request->after_validation($id);
        return response()->json($this->testRepository->getStudentTestQuestions($request, $id), 200);
    }

}