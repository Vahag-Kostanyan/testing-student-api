<?php

namespace App\Http\Requests\Api\admin\teacher;
use App\Http\Requests\api\BaseApiRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class TestQuestionRequest extends FormRequest 
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
           'question_ids.*' => [ 'sometimes', 'required', 'exists:question,id'],
        ];
    }

    public function after_validation(int|string|null $id)
    {
    }

}