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
        $data = auth()->user()->load(['userTests.test'])->userTests ?? []; 
        
        return ['status' => 'success', 'data' => $data];
    }

}