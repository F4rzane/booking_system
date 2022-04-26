<?php

namespace App\SharedKernel\Services\Exceptions;

use App\SharedKernel\Exceptions\BaseException;
use App\SharedKernel\Exceptions\UnexpectedException;
use Illuminate\Validation\ValidationException;

class ServiceException extends BaseException
{
    public static function validation(ValidationException $ex): BaseException
    {
        return UnexpectedException::unknown($ex);
    }

    public static function notFound(): static
    {
        return new self("Class not found");
    }

    public static function serviceInterface(): static
    {
        return new self("Class must implements Service Interface");
    }
}
