<?php

namespace App\Domains\Entity\EntityType\Actions;

use App\SharedKernel\Actions\Resources\AbstractReadAction;

use App\SharedKernel\DTOs\Entity\EntityType\EntityTypeDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\EntityType\Contracts\EntityTypeRepositoryContract;

#[ResponseType(response: ['entity_type' => EntityTypeDTO::class], description: 'Read entity type')]
class ReadEntityTypeAction extends AbstractReadAction
{
    protected string $resourceName = 'entity_type';

    protected bool $authority = true;

    protected bool $public = true;

    protected function getDTO(): string
    {
        return EntityTypeDTO::class;
    }

    public function __construct(EntityTypeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
