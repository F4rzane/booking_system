<?php

namespace App\Domains\Entity\EntityType\Actions;

use App\SharedKernel\Actions\Resources\AbstractDeleteAction;

use App\SharedKernel\DTOs\Entity\EntityType\EntityTypeDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\EntityType\Contracts\EntityTypeRepositoryContract;

#[ResponseType(response: [], description: 'delete entity type')]
class DeleteEntityTypeAction extends AbstractDeleteAction
{
    protected string $resourceName = 'entity_type';

    protected function getDTO(): string
    {
        return EntityTypeDTO::class;
    }

    public function __construct(
        EntityTypeRepositoryContract $repository,
    ) {
        $this->repository = $repository;
    }
}
