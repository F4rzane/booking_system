<?php

namespace App\Domains\Booking;

use App\Domains\Booking\Contracts\OfficeOpeningHourRepositoryContract;
use App\Models\OfficeOpeningHours\OfficeOpeningHours;
use App\SharedKernel\Contracts\Domains\OfficeOpeningHourDomainContract;
use App\SharedKernel\Exceptions\NotFoundException;
use Carbon\Carbon;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class MainOfficeOpeningHour implements OfficeOpeningHourDomainContract
{
    public function __construct(
        protected OfficeOpeningHourRepositoryContract $officeOpeningHoursRepository
    ) {
    }

    /**
     * @throws NotFoundException|UnknownProperties
     */
    public function isOfficeOpen(array $attributes): bool
    {
        $officeOpeningHours = OfficeOpeningHours::query()
            ->where('day', Carbon::createFromFormat('Y-m-d', $attributes['day'])->dayOfWeek)
            ->where('start_time', '<=', $attributes['start_time'])
            ->where('end_time', '>', $attributes['start_time'])
            ->get();
        if (!empty($officeOpeningHours)) {
          return true;
        }
        return false;
    }
}
