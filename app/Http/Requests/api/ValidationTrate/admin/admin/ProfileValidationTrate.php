<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;

use App\Rules\UnknownProperties;

trait ProfileValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function update_validation_rules() : array
    {
        return [
            'username' => ['sometimes', 'string', 'unique:users,email'],
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
