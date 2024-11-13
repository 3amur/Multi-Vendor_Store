<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ForbiddenName implements Rule
{
    protected $names;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($names)
    {
        $this->names = $names;
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
        return !(in_array(strtolower($value), $this->names));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'this value is not allowed .';
    }
}
