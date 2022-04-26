<?php

namespace App\Domains\Entity\Facility\Repositories;

use App\Domains\Entity\Facility\Contracts\FacilityRepositoryContract;
use App\Models\Facility\Facility;
use App\SharedKernel\Repositories\BaseRepository;


class FacilityRepository extends BaseRepository implements FacilityRepositoryContract
{
    public function model() : string
    {
        return Facility::class;
    }
}
