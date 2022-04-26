<?php

namespace App\Domains\Entity\EntityType\Repositories;

use App\Domains\Entity\EntityType\Contracts\EntityTypeRepositoryContract;
use App\SharedKernel\Repositories\BaseRepository;

use App\Models\EntityType\EntityType;

class EntityTypeRepository extends BaseRepository implements EntityTypeRepositoryContract
{
    public function model() : string
    {
        return EntityType::class;
    }
}
