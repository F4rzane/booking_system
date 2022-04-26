<?php

namespace App\Domains\Entity\Entity\Actions;

use App\SharedKernel\Actions\Resources\AbstractDeleteAction;

use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;

#[ResponseType(response: [], description: 'delete entity')]
class DeleteEntityAction extends AbstractDeleteAction
{
    protected string $resourceName = 'entity';

    protected function getDTO(): string
    {
        return EntityDTO::class;
    }

    public function __construct(
        EntityRepositoryContract $repository,
    ) {
        $this->repository = $repository;
    }
}
