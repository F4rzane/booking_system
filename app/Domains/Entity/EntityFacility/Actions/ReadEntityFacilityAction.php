<?php

namespace App\Domains\Entity\EntityFacility\Actions;

use App\SharedKernel\Actions\Resources\AbstractReadAction;

use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;

use App\SharedKernel\DTOs\Entity\EntityFacility\EntityFacilityDTO;

use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['entity_facility' => EntityFacilityDTO::class], description: 'Read entity facility')]
class ReadEntityFacilityAction extends AbstractReadAction
{
    protected string $resourceName = 'entity_facility';

    protected function getDTO(): string
    {
        return EntityFacilityDTO::class;
    }

    public function __construct(EntityFacilityRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
