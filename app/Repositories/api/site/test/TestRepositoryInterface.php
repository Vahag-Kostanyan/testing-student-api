<?php

namespace App\Repositories\api\site\test;
use App\Http\Requests\api\site\TestQuestionsRequest;
use Illuminate\Http\Request;

interface TestRepositoryInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getStudentTest(Request $request) : array;
 
    /**
     * @param TestQuestionsRequest $request
     * @return array
     */
    public function getStudentTestQuestions(TestQuestionsRequest $request, int|string $id) : array;
}