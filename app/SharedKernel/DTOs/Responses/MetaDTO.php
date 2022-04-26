<?php

namespace App\SharedKernel\DTOs\Responses;

use Spatie\DataTransferObject\DataTransferObject;

class MetaDTO extends DataTransferObject
{
    public ?MessageDTO $message;

    public ?array $extra;

    public function toArray(): array
    {
        $array = parent::toArray();

        if (!isset($this->message)) {
            unset($array['message']);
        }

        if (!isset($this->extra)) {
            unset($array['extra']);
        }

        return $array;
    }
}
