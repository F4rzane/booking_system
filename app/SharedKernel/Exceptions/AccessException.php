<?php

namespace App\SharedKernel\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class AccessException extends BaseException
{
    public static function denied(): static
    {
        return new self(
            message: 'Access is denied',
            code: Response::HTTP_FORBIDDEN,
        );
    }
}
