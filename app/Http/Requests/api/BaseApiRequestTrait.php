<?php

namespace App\Http\Requests\api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait BaseApiRequestTrait
{
    /**
     * @param Validator $validator
     * @throws HttpResponseException
     * @inheritDoc
     */
    protected function failedValidation(Validator $validator) : HttpResponseException
    {
        validationException($validator->errors() ?? []);
    }
}
