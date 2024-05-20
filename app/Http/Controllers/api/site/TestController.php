<?php

namespace App\Http\Controllers\api\site;

use App\Http\Controllers\Controller;
use App\Repositories\api\site\test\TestRepositoryInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @param TestRepositoryInterface $testRepository
     * @inheritDoc
     */
    public function __construct(private TestRepositoryInterface $testRepository) {}

    public function getTests(Request $request)
    {
        return response()->json($this->testRepository->getStudentTest($request), 200);
    }
}