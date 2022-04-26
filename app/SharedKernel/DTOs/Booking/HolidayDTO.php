<?php

namespace App\SharedKernel\DTOs\Holiday;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;

class HolidayDTO extends BaseDTO
{
    public int $id;
    public string $day;

}
