<?php

namespace App\Domains\Booking;

use App\Domains\Booking\Contracts\HolidayRepositoryContract;
use App\SharedKernel\Contracts\Domains\EmployeeDomainContract;

use App\Domains\Employee\Contracts\EmployeeRepositoryContract;

use App\SharedKernel\Contracts\Domains\HolidayDomainContract;
use App\SharedKernel\Exceptions\NotFoundException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class MainHoliday implements HolidayDomainContract
{
    public function __construct(
        protected HolidayRepositoryContract $holidayRepository
    ) {
    }

    /**
     * @throws NotFoundException|UnknownProperties
     */
    public function isHoliday(string $day): bool
    {
        $holiday = $this->holidayRepository->findWhere(['date' => $day]);

        if (!empty($holiday)) {
          return true;
        }
        return false;
    }
}
