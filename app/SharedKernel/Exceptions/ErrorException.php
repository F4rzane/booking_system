<?php

namespace App\SharedKernel\Exceptions;

class ErrorException extends BaseException
{
    public function __construct($message = "The process could not be done", $code = 400)
    {
        parent::__construct($message, $code);
    }

    /**
     * @return static
     */
    public static function make(string $message = "The process could not be done"): self
    {
        return new self(__($message));
    }
}
