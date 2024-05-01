<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

trait UserValidationTrate
{
    /**
     * @param Request $request
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(Request $request): array
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
     * @param int|null $id
     * @param Request $request
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return [
            'username' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', Rule::unique('users', 'email')->ignore($id)],
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
