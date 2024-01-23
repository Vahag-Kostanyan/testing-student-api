<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Auth\LoginRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{
    public function createUser(){

    }

    /**
     * @param LoginRequest $request
     * @throws HttpResponseException
     * @return Response
     */
    public function login(LoginRequest $request) : Response
    {
        return $request->authenticate();
    }

    
    /**
     * @param Request $request
     * @return Response
     */
    public function getMe(Request $request) : Response
    {
        return response()->json([
            'user' => auth()->user()
        ], 200);
    }

}
