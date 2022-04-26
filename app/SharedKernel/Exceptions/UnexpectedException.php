<?php

namespace App\SharedKernel\Exceptions;

use Throwable;

class UnexpectedException extends BaseException
{
    public function __construct($message = "Unexpected error occurred!", $code = 500, Throwable $previous = null)
    {
        if (!is_null($previous)) {
            report($previous);
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return static
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * @param Throwable $th
     * @return static
     */
    public static function unknown(Throwable $th): self
    {
        return new self(previous: $th);
    }

    /**
     * @param Throwable $th
     * @return static
     */
    public static function validation(Throwable $th): self
    {
        return new self(previous: $th);
    }
}
