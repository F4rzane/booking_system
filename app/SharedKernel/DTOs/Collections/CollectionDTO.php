<?php

namespace App\SharedKernel\DTOs\Collections;

use Illuminate\Support\Collection;

use App\SharedKernel\DTOs\BaseDTO;

class CollectionDTO extends Collection
{
    public function offsetGet($key): BaseDTO
    {
        return parent::offsetGet($key);
    }
}
