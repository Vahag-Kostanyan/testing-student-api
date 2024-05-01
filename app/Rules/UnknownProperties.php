<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class UnknownProperties implements Rule
{

    /**
     * @param mixed $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(mixed $attribute, mixed $value) : bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function message() : string
    {
        return 'The :attribute is unknown parameter.';
    }
}