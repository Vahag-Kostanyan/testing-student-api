<?php

namespace App\Repositories\api\site\test;

use App\Http\Requests\api\site\TestQuestionsRequest;
use App\Http\Requests\api\site\TestRequest;
use App\Models\TestQuestion;
use App\Models\UserTest;
use Illuminate\Http\Request;

class TestRepository implements TestRepositoryInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getStudentTests(Request $request): array
    {
        $data = auth()->user()->load(['userTests.test'])->userTests ?? []; 
        
        return ['status' => 'success', 'data' => $data];
    }

        /**
     * @param TestRequest $request
     * @param int|string $id
     * @return array
     */ 
    public function getStudentTest(TestRequest $request, int|string $id): array
    {
        $data = UserTest::where('user_id', user()->id)->with(['test', 'test.user', 'test.subject'])->find($id);

        return ['status' => 'success', 'data' => $data];
    }

    /**
     * @param TestQuestionsRequest $request
     * @return array
     */
    public function getStudentTestQuestions(TestQuestionsRequest $request, int|string $id) : array
    {
        $testQuestions = TestQuestion::where('test_id', $id)
        ->with(['question', 'question.questionType', 'question.questionOptions', 'question.questionAnswers'])
        ->get()
        ->toArray();
        
        $data = [];

        foreach($testQuestions as $testQuestion){
            foreach($testQuestion['question']['question_answers'] as $key => $answer) 
            {
                unset($answer['is_right']);
                $testQuestion['question']['question_answers'][$key] = $answer;
            }

            $data[] = $testQuestion['question'];
        }

        return ['status' => 'success', 'data' => $data];
    }

}