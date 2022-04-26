<?php

namespace App\Domains\Entity\Entity\Actions;

use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;
use App\SharedKernel\Actions\Resources\AbstractListAction;

use App\SharedKernel\Attributes\ResponseType;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;

#[ResponseType(response: ['entity' => EntityDTO::class], collection: true, description: 'entity list')]
class ListEntityAction extends AbstractListAction
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
