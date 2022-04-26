<?php

namespace App\SharedKernel\Contracts\Domains;

use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;

interface FacilityDomainContract
{
    public function getFacilityById(string|int $id): FacilityDTO;

    public function facilityExists(array $where): bool;
}
