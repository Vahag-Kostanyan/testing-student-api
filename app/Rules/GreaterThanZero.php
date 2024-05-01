<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class GreaterThanZero implements Rule
{

    /**
     * @param mixed $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(mixed $attribute, mixed $value) : bool
    {
        return $value > 0;
    }

    /**
     * @return string
     */
    public function message() : string
    {
        return 'The :attribute must be greater than zero.';
    }
}