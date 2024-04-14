<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;

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
            'group_id' => ['sometimes', 'exists:group,id'],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
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
            'username' => ['sometimes', 'string', 'unique:users,email'],
            'email' => ['sometimes', 'string', 'unique:users,email'],
            'password' => ['sometimes', 'string'],
            'role_id' => ['sometimes', 'exists:role,id'],
            'group_id' => ['sometimes', 'exists:group,id'],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
            'user_profile.courses' => ['sometimes', 'integer'],
        ];        
    }
}
