<?php

namespace App\Http\Requests\api\admin\teacher;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\Question;
use App\Models\Test;
use App\Rules\IsArray;
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
            'question_ids' => [new IsArray],
            'question_ids.*' => ['sometimes', 'required', 'exists:questions,id'],
        ];
    }

    public function after_validation(int|string|null $id)
    {
        if(!Test::find($id)){
            validationException(["Invalid Test id $id"]);
        }

        $this->merge(['question_ids' => array_unique($this?->question_ids ?? [])]);

        if(!auth()->user()->isSuperAdmin()){
            if(!Test::where('user_id', auth()->user()->id)->find($id)){
                validationException(["Teacher has no Test with id $id"]);
            }

            foreach($this->question_ids as $question_id){
                if(!Question::where('user_id', auth()->user()->id)->where('id', $question_id)->first()){
                    validationException(["Teacher has no questions with id $question_id"]);
                }
            }
        }
    }
}