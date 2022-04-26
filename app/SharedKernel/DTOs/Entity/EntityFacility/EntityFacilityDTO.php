<?php

namespace App\SharedKernel\DTOs\Entity\EntityFacility;

use App\SharedKernel\DTOs\BaseDTO;

class EntityFacilityDTO extends BaseDTO
{
    public int $id;
    public int $entity_id;
    public int $facility_id;
    public ?string $deleted_at;
    public string $created_at;
    public string $updated_at;
}
