<?php

namespace App\Http\Requests\api\Auth;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;
use Throwable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'username' => ['required', 'string'],
            'role_id' => ['required', 'unique:role,id'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return Response
     * @throws HttpResponseException
     */
    public function registore() : Response
    {
        try{
            User::create([
                'username' =>  $this->username,
                'email' =>   $this->email,
                'role_id' =>   $this->role_id,
                'password' =>   Hash::make($this->password),
            ]);

            return response()->json([
                'status' => true,
                'message' =>  'User Created successfuly' 
            ], 201);
        }catch (Throwable $th)
        {
            return new HttpResponseException(response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500));
        }
    }
}
