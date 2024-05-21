<?php

namespace App\Repositories\api\site\test;

use App\Http\Requests\api\site\TestQuestionsRequest;
use Illuminate\Http\Request;

class TestRepository implements TestRepositoryInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getStudentTest(Request $request): array
    {
        $data = auth()->user()->load(['userTests.test'])->userTests ?? []; 
        
        return ['status' => 'success', 'data' => $data];
    }

    /**
     * @param TestQuestionsRequest $request
     * @return array
     */
    public function getStudentTestQuestions(TestQuestionsRequest $request, int|string $id) : array
    {
        
        return ['status' => 'success'];
    }

}