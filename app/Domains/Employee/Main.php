<?php

namespace App\Domains\Employee;

use App\SharedKernel\Contracts\Domains\EmployeeDomainContract;

use App\Domains\Employee\Contracts\EmployeeRepositoryContract;

use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use App\SharedKernel\Exceptions\NotFoundException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Main implements EmployeeDomainContract
{
    public function __construct(
        protected EmployeeRepositoryContract $employeeRepository
    ) {
    }

    /**
     * @throws NotFoundException|UnknownProperties
     */
    public function getEmployeeById(string|int $id): EmployeeDTO
    {
        $employee = $this->employeeRepository->find($id);

        if (!isset($employee)) {
            throw NotFoundException::resource('employee');
        }

        return new EmployeeDTO($employee->toArray());
    }

    public function employeeExists(array $where): bool
    {
        if (!count($where)) {
            return false;
        }

        return $this->employeeRepository->count($where) > 0;
    }
}
