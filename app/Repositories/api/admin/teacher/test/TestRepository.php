<?php   

namespace   App\Repositories\api\admin\teacher\test;
use App\Http\Requests\api\admin\teacher\TestQuestionRequest;
use App\Models\Test;
use App\Models\TestQuestion;
use Exception;


class TestRepository implements TestRepositoryInterface
{
    public function updateTestQuestions(TestQuestionRequest $request, int|null|string $id) : array
    {
        try {
            $test = Test::find($id);
            $testQuestions = $test?->load('testQuestions')->testQuestions;

            $questionIds = $request->input('question_ids');

            foreach ($testQuestions as $testQuestion) {
                if (!in_array($testQuestion->question_id, $questionIds)) {
                    $testQuestion->delete();
                } else {
                    $index = array_search($testQuestion->question_id, $questionIds);
                    unset($questionIds[$index]);
                }
            }


            $newTestQuestions = [];
            foreach ($questionIds as $questionId) {
                $newTestQuestions[] = ['test_id' => $id, 'question_id' => $questionId, 'created_at' => now(), 'updated_at' => now()];
            }
            TestQuestion::insert($newTestQuestions);

        } catch (Exception $error) {
            serverException();
        }

        return ['message' => 'Updated successfully', 'data' => $test->load('testQuestions.question')];
    }
}