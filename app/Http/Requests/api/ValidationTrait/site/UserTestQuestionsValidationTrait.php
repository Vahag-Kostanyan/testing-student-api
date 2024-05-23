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

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function index_after_validation(Request $request): void
    {
        parent::index_after_validation($request);

        if (!$UserTest = UserTest::where('user_id', user()->id)->where('test_id', $request->input('test_id'))->first()) {
            validationException(['test_id' => 'Invalide test id']);
        }

        $this->checkTestTime($UserTest);
    }

    protected function show_before_validation(Request $request, int|null $id): void
    {
        parent::show_before_validation($request, $id);

        if (!$testQuestionAnswer = TestQuestionAnswer::where('user_id', user()->id)->find($id)) {
            validationException(['user_id' => 'Invalide record id ' . $id]);
        }

        $this->checkTestTime(UserTest::where('test_id', $testQuestionAnswer->test_id)->where('user_id', user()->id)->where('status', UserTest::STATUS_PENDING)->first());
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function store_validation_rules(Request $request): array
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
     * @throws HttpResponseException
     */
    protected function store_after_validation(Request $request): void
    {
        parent::store_after_validation($request);

        if (TestQuestionAnswer::where('user_id', user()->id)->where('test_id', $request->input('test_id'))->where('question_id', $request->input('question_id'))->first()) {
            validationException(['user_id' => 'the record alrey exist you must update it']);
        }

        if (!Test::find($request->input('test_id'))) {
            validationException(['test_id' => 'This user cannot use this test with id ' . $request->input('test_id')]);
        }

        if (!Question::find($request->input('question_id'))) {
            validationException(['question_id' => 'This user cannot use this questio with id ' . $request->input('test_id')]);
        }

        if (!Answer::where('question_id', $request->input('question_id'))->find($request->input('answer_id'))) {
            validationException(['answer_id' => 'Invalid answer id ' . $request->input('answer_id')]);
        }

        if (!UserTest::where('test_id', $request->input('test_id'))->where('user_id', user()->id)->where('status', UserTest::STATUS_PENDING)->first()) {
            validationException(['test_id' => 'This user do not have a test with id ' . $request->input('test_id')]);
        }

        $this->checkTestTime(UserTest::where('test_id', $request->input('test_id'))->where('user_id', user()->id)->first());

        $request->merge(['user_id' => user()->id]);
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return [
            'test_id' => [new UnknownProperties],
            'question_id' => [new UnknownProperties],
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
     * @throws HttpResponseException
     */
    protected function update_after_validation(Request $request, int|null $id): void
    {
        parent::update_after_validation($request, $id);

        if (!$TestQuestionAnswer = TestQuestionAnswer::find($id)) {
            validationException(['id' => 'the record is not exists with id ' . $id]);
        }

        if (!Answer::where('question_id', $TestQuestionAnswer->question_id)->find($request->input('answer_id'))) {
            validationException(['answer_id' => 'Invalid answer id ' . $request->input('answer_id')]);
        }

        $this->checkTestTime(UserTest::where('test_id', $TestQuestionAnswer->test_id)->where('user_id', user()->id)->first());
    }

    private function checkTestTime(UserTest|null $userTest)
    {
        if (!$userTest) {
            validationException(['test_id' => 'Invalid user test']);
        }

        date_default_timezone_set('Asia/Yerevan');

        if (strtotime($userTest->test_data_from) > time() || strtotime($userTest->test_data_to) < time()) {
            validationException(["you can take the test from " . $userTest->test_data_from . ' to ' . $userTest->test_data_to]);
        }
    }
}