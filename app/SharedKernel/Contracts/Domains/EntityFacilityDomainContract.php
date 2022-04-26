<?php

namespace App\SharedKernel\Contracts\Domains;

interface EntityFacilityDomainContract
{
    public function entityFacilityExists(array $where): bool;
}
