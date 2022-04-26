<?php

namespace App\Domains\Entity\EntityType\Actions;

use App\Domains\Entity\EntityType\Contracts\EntityTypeRepositoryContract;
use App\SharedKernel\Actions\Resources\AbstractListAction;

use App\SharedKernel\Attributes\ResponseType;
use App\SharedKernel\DTOs\Entity\EntityType\EntityTypeDTO;

#[ResponseType(response: ['entity_type' => EntityTypeDTO::class], collection: true, description: 'entity types list')]
class ListEntityTypeAction extends AbstractListAction
{
    protected string $resourceName = 'entity_type';

    protected array $relations = [];

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
