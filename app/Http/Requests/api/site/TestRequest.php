<?php

namespace App\Http\Requests\api\site;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\UserTest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TestRequest extends FormRequest
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
     * @throws HttpResponseException
     */
    public function after_validation(int|string $id): void
    {
        if (!$userTest = UserTest::where('test_id', $id)->where('user_id', user()->id)->first()) {
            validationException(["Invalid Test id $id"]);
        }

        date_default_timezone_set('Asia/Yerevan');

        if (strtotime($userTest->test_data_from) > time() || strtotime($userTest->test_data_to) < time()) {
            validationException(["you can take the test from " . $userTest->test_data_from . ' to ' . $userTest->test_data_to]);
        }
    }
}
