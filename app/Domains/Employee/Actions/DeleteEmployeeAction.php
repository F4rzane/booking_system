<?php

namespace App\Domains\Employee\Actions;

use App\SharedKernel\Actions\Resources\AbstractDeleteAction;

use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Employee\Contracts\EmployeeRepositoryContract;

#[ResponseType(response: [], description: 'delete employee')]
class DeleteEmployeeAction extends AbstractDeleteAction
{
    protected string $resourceName = 'employee';

    protected function getDTO(): string
    {
        return EmployeeDTO::class;
    }

    public function __construct(
        EmployeeRepositoryContract $repository,
    ) {
        $this->repository = $repository;
    }
}
