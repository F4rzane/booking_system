<?php

namespace App\Domains\Entity\Facility\Actions;

use App\SharedKernel\Actions\Resources\AbstractDeleteAction;

use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\Facility\Contracts\FacilityRepositoryContract;

#[ResponseType(response: [], description: 'delete entity')]
class DeleteFacilityAction extends AbstractDeleteAction
{
    protected string $resourceName = 'entity';

    protected function getDTO(): string
    {
        return FacilityDTO::class;
    }

    public function __construct(
        FacilityRepositoryContract $repository,
    ) {
        $this->repository = $repository;
    }
}
