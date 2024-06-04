<?php

namespace App\Http\Requests\site;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\UserTest;
use Illuminate\Foundation\Http\FormRequest;

class TestResultRequest extends FormRequest
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
        return [];
    }

    /**
     * @return void
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function after_validation(int|string $id): void
    {
        $userTest = UserTest::where('test_id', $id)->where('user_id', user()->id)->first();

        if (!$userTest) {
            validationException(["Invalid Test id $id"]);
        }

        if ($userTest->status === UserTest::STATUS_PENDING) {
            validationException(["Test hasn't finished yet"]);
        }
    }
}
