<?php

namespace App\Domains\Employee\Repositories;

use App\Domains\Employee\Contracts\EmployeeRepositoryContract;
use App\SharedKernel\Repositories\BaseRepository;

use App\Models\Employee\Employee;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryContract
{
    public function model() : string
    {
        return Employee::class;
    }
}
