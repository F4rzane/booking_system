<?php

namespace App\Domains\Booking\Exceptions;

use App\SharedKernel\Exceptions\ErrorException;

class BookingException extends ErrorException
{
    public static function duplicateEntityType(): self
    {
        return new self(__("You are not allowed to book multiple entities with same type"));
    }

    public static function entityIsAlreadyBooked(): self
    {
        return new self(__("entity is already booked"));
    }

    public static function entityIsNotAvailableInHolidays(): self
    {
        return new self(__("entity is not available in holidays"));
    }

    public static function OfficeIsClosed(): self
    {
        return new self(__("office is not open in this time"));
    }
}
