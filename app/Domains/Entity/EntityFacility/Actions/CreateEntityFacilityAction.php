<?php

namespace App\Domains\Entity\EntityFacility\Actions;

use App\SharedKernel\Actions\Resources\AbstractCreateAction;

use App\SharedKernel\Contracts\Domains\EntityDomainContract;
use App\SharedKernel\Contracts\Domains\FacilityDomainContract;
use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;
use App\SharedKernel\DTOs\Entity\EntityFacility\EntityFacilityDTO;

use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\EntityFacility\Exceptions\EntityFacilityException;

#[ResponseType(response: ['entity_facility' => EntityFacilityDTO::class], description: 'create new entity facility')]
class CreateEntityFacilityAction extends AbstractCreateAction
{
    protected string $resourceName = 'entity_facility';

    protected function getDTO(): string
    {
        return EntityFacilityDTO::class;
    }

    public function __construct(
        protected EntityDomainContract   $entityMainEntry,
        protected FacilityDomainContract $facilityMainEntry,
        EntityFacilityRepositoryContract $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * @throws EntityFacilityException
     */
    protected function createResource(): BaseDTO|EntityFacilityDTO
    {
        $entityDTO = $this->entityMainEntry->getEntityById($this->safe()->get('entity_id'));
        $facilityDTO = $this->facilityMainEntry->getFacilityById($this->safe()->get('facility_id'));

        return $this->handle(
            entityDTO: $entityDTO,
            facilityDTO: $facilityDTO,
        );
    }

    /**
     * @throws EntityFacilityException
     */
    public function handle(
        EntityDTO $entityDTO,
        FacilityDTO $facilityDTO
    ): BaseDTO|EntityFacilityDTO
    {
        $isDuplicate = $this->repository->count([

            'entity_id' => $entityDTO->id,
            'facility_id' => $facilityDTO->id,
        ]);

        if ($isDuplicate) {
            throw EntityFacilityException::duplicateEntityFacility();
        }

        $model = DB::transaction(function () use ($entityDTO, $facilityDTO) {
            return $this->repository->forceFillCreate([
                'entity_id' => $entityDTO->id,
                'facility_id' => $facilityDTO->id,
            ]);
        });

        return $this->getDTOInstance($model->toArray());
    }

    public function rules(): array
    {
        return [
            'entity_id' => ['required', 'entity_exists'],
            'facility_id' => ['required', 'facility_exists'],
        ];
    }

    public function asObjectRules(): array
    {
        return [];
    }
}
