<?php

namespace App\Repositories\api\site\testQuestionAnswer;

use App\Models\TestQuestionAnswer;
use Illuminate\Http\Request;

class TestQuestionAnswerRepository implements TestQuestionAnswerRepositoryInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) : mixed
    {
        $testQuestionAnswers = TestQuestionAnswer::where('user_id', user()->id)->where('test_id', $request->input('test_id'))->get();

        return ['status' => 'success', 'data' => $testQuestionAnswers];
    }
}