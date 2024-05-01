<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;
use App\Rules\UnknownProperties;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

trait StudentsValidationTrate
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
            'role_id' => [new UnknownProperties()],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
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
            'role_id' => [new UnknownProperties()],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
            'user_profile.courses' => ['sometimes', 'integer'],
        ];        
    }
}
