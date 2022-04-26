<?php

namespace App\Domains\Employee\Actions;

use App\SharedKernel\Actions\Resources\AbstractListAction;

use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Employee\Contracts\EmployeeRepositoryContract;

#[ResponseType(response: ['employee' => EmployeeDTO::class], collection: true, description: 'employees list')]
class ListEmployeeAction extends AbstractListAction
{
    protected string $resourceName = 'employee';

    protected array $relations = [];

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
