<?php

namespace App\SharedKernel\DTOs\Entity\Entity;

use App\Models\EntityType\EntityType;
use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\EntityType\EntityTypeDTO;

class EntityDTO extends BaseDTO
{
    public int $id;
    public ?EntityTypeDTO $entity_type;
    public ?int $entity_type_id;
    public ?string $name;
    public ?string $description;
    public ?int $max_simultaneous_booking;
    public ?bool $available_in_holidays;
    public ?string $created_at;
    public ?string $updated_at;
}
