<?php

namespace App\Repositories\api\site\test;

use App\Http\Requests\api\site\TestQuestionsRequest;
use App\Models\TestQuestion;
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