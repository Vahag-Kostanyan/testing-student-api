<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class IsArray implements Rule
{

    /**
     * @param mixed $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(mixed $attribute, mixed $value) : bool
    {
        return is_array($value);
    }

    /**
     * @return string
     */
    public function message() : string
    {
        return 'The :attribute must be array.';
    }
}