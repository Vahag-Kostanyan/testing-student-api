<?php

namespace App\Repositories\api\site\test;
use Illuminate\Http\Request;

interface TestRepositoryInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getStudentTest(Request $request) : array;
    
}