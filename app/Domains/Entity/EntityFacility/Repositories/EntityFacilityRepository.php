<?php

namespace App\Domains\Entity\EntityFacility\Repositories;

use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;
use App\Models\EntityFacility\EntityFacility;
use App\SharedKernel\Repositories\BaseRepository;


class EntityFacilityRepository extends BaseRepository implements EntityFacilityRepositoryContract
{
    public function model() : string
    {
        return EntityFacility::class;
    }
}
