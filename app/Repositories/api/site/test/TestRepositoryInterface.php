<?php

namespace App\Repositories\api\site\test;
use App\Http\Requests\api\site\TestQuestionsRequest;
use App\Http\Requests\api\site\TestRequest;
use Illuminate\Http\Request;

interface TestRepositoryInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getStudentTests(Request $request) : array;
 
    /**
     * @param TestRequest $request
     * @param int|string $id
     * @return array
     */
    public function getStudentTest(TestRequest $request, int|string $id) : array;
 
    /**
     * @param TestQuestionsRequest $request
     * @return array
     */
    public function getStudentTestQuestions(TestQuestionsRequest $request, int|string $id) : array;
}