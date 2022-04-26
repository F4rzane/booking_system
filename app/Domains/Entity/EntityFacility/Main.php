<?php

namespace App\Domains\Entity\EntityFacility;

use App\SharedKernel\Contracts\Domains\EntityFacilityDomainContract;

use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;

class Main implements EntityFacilityDomainContract
{
    public function __construct(
        protected EntityFacilityRepositoryContract $entityFacilityRepository,
    ) {
    }

    public function entityFacilityExists(array $where): bool
    {
        if (!count($where)) {
            return false;
        }

        return $this->entityFacilityRepository->count($where) > 0;
    }
}
