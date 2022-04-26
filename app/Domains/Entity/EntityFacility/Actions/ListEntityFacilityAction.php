<?php

namespace App\Domains\Entity\EntityFacility\Actions;

use App\SharedKernel\Actions\Resources\AbstractListAction;

use App\SharedKernel\DTOs\Entity\EntityFacility\EntityFacilityDTO;

use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;

#[ResponseType(response: ['entity_facility' => EntityFacilityDTO::class], collection: true, description: 'entity facility list')]
class ListEntityFacilityAction extends AbstractListAction
{
    protected string $resourceName = 'entity_facility';

    protected array $relations = [];

    protected function getDTO(): string
    {
        return EntityFacilityDTO::class;
    }

    public function __construct(EntityFacilityRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
