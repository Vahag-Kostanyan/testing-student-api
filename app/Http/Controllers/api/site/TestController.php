<?php

namespace App\Http\Controllers\api\site;
use App\Http\Controllers\Controller;
use App\Repositories\Api\site\test\TestRepositoryInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct( private TestRepositoryInterface $testRepository ){}

    public function getTests(Request $request) {
    }
}