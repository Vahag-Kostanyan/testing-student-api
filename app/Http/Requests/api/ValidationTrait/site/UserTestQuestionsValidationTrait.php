<?php

namespace App\Http\Requests\api\ValidationTrait\site;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestionAnswer;
use App\Models\UserTest;
use App\Rules\UnknownProperties;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

trait UserTestQuestionsValidationTrait
{

    protected function show_before_validation(Request $request, int|null $id): void
    {
        parent::show_before_validation($request, $id);

        if (!$testQuestionAnswer = TestQuestionAnswer::where('user_id', auth()->user()->id)->find($id)) {
            validationException(['user_id' => 'Invalide record id ' . $id]);
        }

        $this->checkTestTime(UserTest::where('test_id', $testQuestionAnswer->test_id)->where('user_id', auth()->user()->id)->where('status', UserTest::STATUS_PENDING)->first());
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function store_validation_rules(Request $request): array
    {
        return $this->validation_rules();
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function store_after_validation(Request $request): void
    {
        parent::store_after_validation($request);

        if (TestQuestionAnswer::where('user_id', auth()->user()->id)->where('test_id', $request->input('test_id'))->where('question_id', $request->input('question_id'))->first()) {
            validationException(['user_id' => 'the record alrey exist you must update it']);
        }

        $this->after_validation($request);
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return $this->validation_rules();
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function update_after_validation(Request $request, int|null $id): void
    {
        parent::update_after_validation($request, $id);

        if (TestQuestionAnswer::find($id)) {
            validationException(['id' => 'the record is not exists with id ' . $id]);
        }

        $this->after_validation($request);
    }


    /**
     * @return array
     */
    private function validation_rules(): array
    {
        return [
            'test_id' => ['required', 'integer', 'exists:test,id'],
            'question_id' => ['required', 'integer', 'exists:questions,id'],
            'answer_id' => ['required', 'integer', 'exists:answer,id'],
            'user_id' => [new UnknownProperties],
            'created_at' => [new UnknownProperties],
            'updated_at' => [new UnknownProperties],
            'id' => [new UnknownProperties],
        ];
    }

    /**
     * @param Request $request
     * @return void
     */
    private function after_validation(Request $request): void
    {
        if (!Test::find($request->input('test_id'))) {
            validationException(['test_id' => 'This user cannot use this test with id ' . $request->input('test_id')]);
        }

        if (!Question::find($request->input('question_id'))) {
            validationException(['test_id' => 'This user cannot use this questio with id ' . $request->input('test_id')]);
        }

        if (!Answer::where('question_id', $request->input('question_id'))->find($request->input('answer_id'))) {
            validationException(['question_id' => 'Invalid answer id ' . $request->input('test_id')]);
        }

        if (!UserTest::where('test_id', $request->input('test_id'))->where('user_id', auth()->user()->id)->where('status', UserTest::STATUS_PENDING)->first()) {
            validationException(['test_id' => 'This user do not have a test with id ' . $request->input('test_id')]);
        }

        $this->checkTestTime(UserTest::where('test_id', $request->input('test_id'))->where('user_id', auth()->user()->id)->first());

        $request->merge(['user_id', auth()->user()->id]);

    }

    private function checkTestTime(UserTest|null $userTest)
    {
        if(!$userTest){
            validationException(['test_id' => 'Invalid user test']);
        }

        date_default_timezone_set('Asia/Yerevan');        

        if(strtotime($userTest->test_data_from) > time() || strtotime($userTest->test_data_to) < time()){
            validationException(["you can take the test from " . $userTest->test_data_from . ' to ' . $userTest->test_data_to]);
        }
    }
}
