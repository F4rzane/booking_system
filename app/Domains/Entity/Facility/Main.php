<?php

namespace App\Domains\Entity\Facility;

use App\SharedKernel\Contracts\Domains\FacilityDomainContract;

use App\Domains\Entity\Facility\Contracts\FacilityRepositoryContract;

use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;
use App\SharedKernel\Exceptions\NotFoundException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Main implements FacilityDomainContract
{
    public function __construct(
        protected FacilityRepositoryContract $facilityRepository
    ) {
    }

    /**
     * @throws NotFoundException|UnknownProperties
     */
    public function getFacilityById(string|int $id): FacilityDTO
    {
        $facility = $this->facilityRepository->find($id);

        if (!isset($facility)) {
            throw NotFoundException::resource('facility');
        }

        return new FacilityDTO($facility->toArray());
    }

    public function facilityExists(array $where): bool
    {
        if (!count($where)) {
            return false;
        }

        return $this->facilityRepository->count($where) > 0;
    }
}
