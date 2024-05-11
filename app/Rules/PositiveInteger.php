<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PositiveInteger implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the value is a positive integer or zero
        return is_numeric($value) && $value >= 0 && intval($value) == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute harus Integer Positif atau Nol.';
    }
}
