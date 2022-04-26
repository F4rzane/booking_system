<?php

namespace App\Domains\Entity\EntityFacility\Actions;

use App\Domains\Entity\EntityFacility\Exceptions\EntityFacilityException;
use App\SharedKernel\Actions\Resources\AbstractUpdateAction;

use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;

use App\SharedKernel\Contracts\Domains\EntityDomainContract;
use App\SharedKernel\Contracts\Domains\FacilityDomainContract;
use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use App\SharedKernel\DTOs\Entity\EntityFacility\EntityFacilityDTO;

use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['entity_facility' => EntityFacilityDTO::class], description: 'update entity facility')]
class UpdateEntityFacilityAction extends AbstractUpdateAction
{
    protected string $resourceName = 'entity_facility';

    protected function getDTO(): string
    {
        return EntityFacilityDTO::class;
    }

    public function __construct(
        protected EntityDomainContract   $entityMainEntry,
        protected FacilityDomainContract $facilityMainEntry,
        EntityFacilityRepositoryContract $repository
    ) {
        $this->repository = $repository;
    }

    protected function updateResource(BaseDTO|EntityFacilityDTO $dto): BaseDTO|EntityFacilityDTO
    {
        $entityDTO = $this->entityMainEntry->getEntityById($this->safe()->get('entity_id'));
        $facilityDTO = $this->facilityMainEntry->getFacilityById($this->safe()->get('facility_id'));

        return $this->handle(
            $dto,
            entityDTO: $entityDTO,
            facilityDTO: $facilityDTO,
        );
    }

    /**
     * @throws EntityFacilityException
     */
    public function handle(
        $dto,
        EntityDTO $entityDTO,
        FacilityDTO $facilityDTO,
    ): BaseDTO|EntityFacilityDTO
    {

        $model = DB::transaction(function () use ($entityDTO, $facilityDTO, $dto) {
            return $this->repository->forceFillUpdate([
                'entity_id' => $entityDTO->id,
                'facility_id' => $facilityDTO->id,
            ],
            $dto->id);
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
}
