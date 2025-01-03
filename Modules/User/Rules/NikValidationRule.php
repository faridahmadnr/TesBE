<?php

namespace Modules\User\Rules;

use App\Support\NikParser;
use Illuminate\Contracts\Validation\Rule;

class NikValidationRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $nikParser = new NikParser($value);

        return $nikParser->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The NIK is invalid.';
    }
}
