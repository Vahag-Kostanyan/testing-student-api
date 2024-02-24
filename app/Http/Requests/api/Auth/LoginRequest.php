<?php

namespace App\Http\Requests\api\Auth;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;  
use Throwable;

class LoginRequest extends FormRequest
{
    use BaseApiRequestTrait;
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return Response
     * @throws HttpResponseException
     */
    public function authenticate() : Response
    {
        try{
            if(!Auth::attempt($this->only(['email', 'password']))){
                throw new HttpResponseException(response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401));
            }
    
            $user = User::where('email', $this->email)->first();
    
            return response()->json([
                'status' => 200,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
            
        }catch (Throwable $th)
        {
            return new HttpResponseException(response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500));
        }
    }
}
