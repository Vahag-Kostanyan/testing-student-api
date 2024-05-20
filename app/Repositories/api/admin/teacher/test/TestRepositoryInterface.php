<?php

namespace   App\Repositories\api\admin\teacher\test;
use App\Http\Requests\api\admin\teacher\TestQuestionRequest;

interface TestRepositoryInterface
{
    public function updateTestQuestions(TestQuestionRequest $request, int|null|string $id) : array;
}