<?php

namespace App\Domains\Entity\EntityFacility\Actions;

use App\SharedKernel\Actions\Resources\AbstractDeleteAction;

use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;

use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;
use App\SharedKernel\DTOs\Entity\EntityFacility\EntityFacilityDTO;

use App\SharedKernel\Attributes\ResponseType;
use Prettus\Repository\Exceptions\RepositoryException;

#[ResponseType(response: [], description: 'delete entity facility')]
class DeleteEntityFacilityAction extends AbstractDeleteAction
{
    protected string $resourceName = 'entity_facility';

    protected function getDTO(): string
    {
        return EntityFacilityDTO::class;
    }

    public function __construct(
        EntityFacilityRepositoryContract $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * @throws RepositoryException
     */
    public function handle(FacilityDTO $facilityDTO, EntityDTO $entityDTO): void
    {
        $entityFacilityDTO = $this->repository->findWhere([
            'entity_id' => $entityDTO->id,
            'facility_id' => $facilityDTO->id,
        ]);

        $this->deleteResource($entityFacilityDTO);
    }
}
