<?php

namespace App\Domains\Entity\Entity\Repositories;

use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;
use App\SharedKernel\Repositories\BaseRepository;

use App\Models\Entity\Entity;

class EntityRepository extends BaseRepository implements EntityRepositoryContract
{
    public function model() : string
    {
        return Entity::class;
    }
}
