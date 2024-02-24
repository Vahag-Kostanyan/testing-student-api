<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Auth\CreateUserRequest;
use App\Http\Requests\api\Auth\LoginRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{

    /**
     * @param CreateUserRequest $request
     * @throws HttpResponseException
     * @return Response
     */
    public function createUser(CreateUserRequest $request) : Response
    {
        return $request->registore();
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
