<?php

namespace App\Domains\Entity\EntityFacility\Exceptions;

use App\SharedKernel\Exceptions\ErrorException;

class EntityFacilityException extends ErrorException
{
    public static function duplicateEntityFacility(): self
    {
        return new self(__("Facility is already exists."));
    }
}
