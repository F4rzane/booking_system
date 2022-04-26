<?php

namespace App\SharedKernel\DTOs\Responses;

use Spatie\DataTransferObject\DataTransferObject;

class MessageDTO extends DataTransferObject
{
    public string $type;

    public string $body;

    public ?string $description;

    public function toArray(): array
    {
        $array = parent::toArray();

        if (!isset($this->description)) {
            unset($array['description']);
        }

        return $array;
    }
}
