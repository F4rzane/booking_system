<?php

namespace App\SharedKernel\Contracts\Domains;

use App\SharedKernel\DTOs\Employee\EmployeeDTO;

interface EmployeeDomainContract
{
    public function getEmployeeById(string|int $id): EmployeeDTO;

    public function employeeExists(array $where): bool;
}
