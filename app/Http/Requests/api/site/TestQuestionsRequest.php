<?php

namespace App\Http\Requests\api\site;

use App\Http\Requests\api\BaseApiRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TestQuestionsRequest extends FormRequest
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
     * @return void
     * @throws HttpResponseException
     */
    public function after_validation(int|string $id ) : void
    {
        dd(222);
    }
}
