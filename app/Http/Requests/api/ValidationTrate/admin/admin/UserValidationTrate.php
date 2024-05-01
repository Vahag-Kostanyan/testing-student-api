<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;

use Illuminate\Validation\Rule;

trait UserValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string'],
            'role_id' => ['required', 'exists:role,id'],
            'user_profile.first_name' => ['sometimes', 'nullable'],
            'user_profile.last_name' => ['sometimes', 'nullable'],
            'user_profile.middle_name' => ['sometimes', 'nullable'],
            'user_profile.age' => ['sometimes', 'nullable'],
            'user_profile.courses' => ['sometimes', 'integer'],
        ];
    }

    /**
     * @return array
     * @inheritDoc
     */
    protected function update_validation_rules() : array
    {
        return [
            'username' => ['sometimes', 'string', 'unique:users,email', Rule::unique('users')->ignore(2)],
            'email' => ['sometimes', 'string', 'unique:users,email'],
            'password' => ['sometimes', 'string'],
            'role_id' => ['sometimes', 'exists:role,id'],
            'user_profile.first_name' => ['sometimes', 'nullable'],
            'user_profile.last_name' => ['sometimes', 'nullable'],
            'user_profile.middle_name' => ['sometimes', 'nullable'],
            'user_profile.age' => ['sometimes', 'nullable'],
            'user_profile.courses' => ['sometimes', 'nullable'],
        ];        
    }
}
