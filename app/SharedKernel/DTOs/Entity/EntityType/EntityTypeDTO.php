<?php

namespace App\SharedKernel\DTOs\Entity\EntityType;

use App\SharedKernel\DTOs\BaseDTO;

class EntityTypeDTO extends BaseDTO
{
    public int $id;
    public ?string $name;
    public ?string $description;
    public string $created_at;
    public string $updated_at;
}
