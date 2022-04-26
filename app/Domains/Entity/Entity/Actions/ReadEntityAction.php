<?php

namespace App\Domains\Entity\Entity\Actions;

use App\SharedKernel\Actions\Resources\AbstractReadAction;

use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;

#[ResponseType(response: ['entity_type' => EntityDTO::class], description: 'Read entity type')]
class ReadEntityAction extends AbstractReadAction
{
    protected string $resourceName = 'entity';
    protected array $relations = ['entityType'];


    protected bool $authority = true;

    protected bool $public = true;

    protected function getDTO(): string
    {
        return EntityDTO::class;
    }

    public function __construct(EntityRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
