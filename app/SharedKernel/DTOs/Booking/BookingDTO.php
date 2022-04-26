<?php

namespace App\SharedKernel\DTOs\Booking;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;

class BookingDTO extends BaseDTO
{
    public int $id;
    public ?EntityDTO $entity;
    public ?EmployeeDTO $employeeDTO;
    public string $start_time;
    public string $day;
    public string $end_time;
    public string $created_at;
    public string $updated_at;

}
