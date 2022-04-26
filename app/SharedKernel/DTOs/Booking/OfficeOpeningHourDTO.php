<?php

namespace App\SharedKernel\DTOs\Booking;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;

class OfficeOpeningHourDTO extends BaseDTO
{
    public int $id;
    public string $day;
    public string $start_time;
    public string $end_time;

}
