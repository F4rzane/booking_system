<?php

namespace App\SharedKernel\Contracts\Domains;

use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;

interface EntityDomainContract
{
    public function getEntityById(string|int $id): EntityDTO;

    public function entityExists(array $where): bool;
}
