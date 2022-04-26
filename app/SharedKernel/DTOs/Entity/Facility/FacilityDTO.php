<?php

namespace App\SharedKernel\DTOs\Entity\Facility;

use App\Models\EntityType\EntityType;
use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\EntityType\EntityTypeDTO;

class FacilityDTO extends BaseDTO
{
    public int $id;
    public ?EntityTypeDTO $entity_type;
    public ?string $name;
    public ?string $description;
    public ?string $created_at;
    public ?string $updated_at;
}
