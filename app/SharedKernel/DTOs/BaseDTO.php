<?php

namespace App\SharedKernel\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

use App\SharedKernel\DTOs\Collections\CollectionDTO;

abstract class BaseDTO extends DataTransferObject
{
    public static function asCollection(mixed $value): CollectionDTO
    {
        return new CollectionDTO(array_map(
            fn (array $data) => new static(...$data),
            $value
        ));
    }
}
