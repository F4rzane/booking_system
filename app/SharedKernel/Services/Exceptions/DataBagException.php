<?php

namespace App\SharedKernel\Services\Exceptions;

use App\SharedKernel\Exceptions\BaseException;

class DataBagException extends BaseException
{
    public static function undefined($key): static
    {
        return new self("{$key} key does not exist in data bag.");
    }
}
