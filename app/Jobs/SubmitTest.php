<?php

namespace App\Jobs;

use App\Mail\SendUserTestResult;
use App\Models\Test;
use App\Models\TestQuestionAnswer;
use App\Models\User;
use App\Models\UserTest;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SubmitTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Test $test, private User $user)
    {
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle(): void
    {
        try {
            $pointSum = 0;
            $rightAnswersPointSum = 0;
            $questionCount = 0;

            $testQuestions = $this->test->load('testQuestions.question.rightQuestionAnswer')->testQuestions;

            foreach ($testQuestions as $testQuestion) {
                $pointSum += $testQuestion->question->point;
                $questionCount++;
                if (TestQuestionAnswer::where('user_id', $this->user->id)->where('test_id', $this->test->id)->where('question_id', $testQuestion->question->id)->first()) {
                    $rightAnswersPointSum += $testQuestion->question->point;
                }
            }

            $result = $rightAnswersPointSum / $pointSum * 100;

            $userTest = UserTest::where('user_id', $this->user->id)->where('test_id', $this->test->id)->where('status', UserTest::STATUS_PENDING)->first();

            $userTest->mark = $result;
            $userTest->status = $result >= 40 ? UserTest::STATUS_SUCCESS : UserTest::STATUS_FAILED;

            Mail::to($this->user->email)->send(new SendUserTestResult($this->user->username, $userTest->load('test')->test->name, $userTest->status === UserTest::STATUS_SUCCESS ? true : false, $result));
            $userTest->save();
        } catch (Exception $error) {
            serverException();
        }
    }
}
