<?php

namespace App\Repositories\api\site\test;

use Illuminate\Http\Request;

class TestRepository implements TestRepositoryInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getStudentTest(Request $request): array
    {
        $data = [];

        dd(auth()->user()->load('userTests'));

        return ['status' => 'successfully', 'data' => $data];
    }

}