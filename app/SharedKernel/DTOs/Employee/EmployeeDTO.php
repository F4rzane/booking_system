<?php

namespace App\SharedKernel\DTOs\Employee;

use App\SharedKernel\DTOs\BaseDTO;

class EmployeeDTO extends BaseDTO
{
    public int $id;
    public string $name;
    public string $user_name;
    public ?string $email;
    public ?string $mobile;
    public string $created_at;
    public string $updated_at;
}
