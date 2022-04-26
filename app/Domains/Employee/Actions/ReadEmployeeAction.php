<?php

namespace App\Domains\Employee\Actions;

use App\SharedKernel\Actions\Resources\AbstractReadAction;

use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Employee\Contracts\EmployeeRepositoryContract;

#[ResponseType(response: ['employee' => EmployeeDTO::class], description: 'Read employee')]
class ReadEmployeeAction extends AbstractReadAction
{
    protected string $resourceName = 'employee';

    protected bool $authority = true;

    protected bool $public = true;

    protected function getDTO(): string
    {
        return EmployeeDTO::class;
    }

    public function __construct(EmployeeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
