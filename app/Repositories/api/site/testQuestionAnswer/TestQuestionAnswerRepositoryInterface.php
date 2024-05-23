<?php

namespace App\Repositories\api\site\testQuestionAnswer;

use Illuminate\Http\Request;

interface TestQuestionAnswerRepositoryInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) : mixed;

}