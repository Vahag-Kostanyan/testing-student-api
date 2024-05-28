<?php

namespace App\Http\Controllers\api\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\site\SubmitTestRequest;
use App\Http\Requests\api\site\TestQuestionsRequest;
use App\Http\Requests\api\site\TestRequest;
use App\Http\Requests\site\TestResultRequest;
use App\Jobs\SubmitTest;
use App\Models\Test;
use App\Models\UserTest;
use App\Repositories\api\site\test\TestRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @param TestRepositoryInterface $testRepository
     * @inheritDoc
     */
    public function __construct(private TestRepositoryInterface $testRepository)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getTests(Request $request): JsonResponse
    {
        return response()->json($this->testRepository->getStudentTests($request), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getTest(TestRequest $request, int|string $id): JsonResponse
    {
        $request->after_validation($id);
        return response()->json($this->testRepository->getStudentTest($request, $id), 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function getTestQuestions(TestQuestionsRequest $request, int|string $id): JsonResponse
    {
        $request->after_validation($id);
        return response()->json($this->testRepository->getStudentTestQuestions($request, $id), 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function submitTest(SubmitTestRequest $request, int|string $id): JsonResponse
    {
        $request->after_validation($id);
        SubmitTest::dispatch(Test::find($id), user());
        return response()->json(['message' => 'Test submitted successfully', 'data' => UserTest::where('user_id', user()->id)->where('test_id', $id)->first()], 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function testResult(TestResultRequest $request, int|string $id): JsonResponse
    {
        $request->after_validation($id);
        return response()->json(['message' => 'Test result success', 'data' => UserTest::where('user_id', user()->id)->where('test_id', $id)->first()], 200);
    }
}