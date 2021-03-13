<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxNubeWordsRule implements Rule
{
    private $maxWords;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($maxWords = 5)
    {
        $this->maxWords = $maxWords;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $words = explode(",", $value);
        return count($words) <= $this->maxWords;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No puede tener más de palabras ' . $this->maxWords . ' palabras.';
    }
}
