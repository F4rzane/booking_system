<?php

namespace App\SharedKernel\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException as BaseValidationException;

class ValidationException extends BaseException
{
    public function __construct($message = "The given data was invalid.", $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param BaseValidationException $ex
     * @return static
     */
    public static function make(BaseValidationException $ex): self
    {
        return (new self(previous: $ex))->setErrors($ex->errors());
    }
}
