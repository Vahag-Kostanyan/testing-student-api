<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;
use App\Rules\UnknownProperties;

trait TeachersValidationTrate
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
            'role_id' => [new UnknownProperties()],
            'subject_ids.*' => ['sometimes', 'exists:subject,id'],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
            'user_profile.courses' => [new UnknownProperties()],
        ];
    }

    /**
     * @return array
     * @inheritDoc
     */
    protected function update_validation_rules() : array
    {
        return [
            'username' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', 'unique:users,email'],
            'password' => ['sometimes', 'string'],
            'role_id' => [new UnknownProperties()],
            'subject_ids.*' => ['sometimes', 'exists:subject,id'],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
            'user_profile.courses' => [new UnknownProperties()],
        ];        
    }
}
