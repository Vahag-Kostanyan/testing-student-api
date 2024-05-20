<?php   

namespace   App\Repositories\Api\Admin\teacher\test;
use App\Http\Requests\Api\admin\teacher\TestQuestionRequest;


class TestRepository implements TestRepositoryInterface
{
    public function updateTestQuestions(TestQuestionRequest $request, int|null|string $id) : array
    {
        return [];
    }
}