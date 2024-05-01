<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;

use App\Rules\UnknownProperties;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

trait ProfileValidationTrate
{
    /**
     * @param int|null $id
     * @param Request $request
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return [
            'username' => ['sometimes', 'string', Rule::unique('users', 'email')->ignore($id)],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
            'user_profile.courses' => [new UnknownProperties()], 
            'email' => [new UnknownProperties()], 
            'password' => [new UnknownProperties()], 
            'role_id' => [new UnknownProperties()], 
        ];
    }
}
