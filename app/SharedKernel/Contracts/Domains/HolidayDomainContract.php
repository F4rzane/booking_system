<?php

namespace App\SharedKernel\Contracts\Domains;

use App\SharedKernel\DTOs\Holiday\HolidayDTO;

interface HolidayDomainContract
{

    public function isHoliday(string $day): bool;
}
