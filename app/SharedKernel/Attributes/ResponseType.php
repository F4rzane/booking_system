<?php

namespace App\SharedKernel\Attributes;

use Attribute;

#[Attribute]
class ResponseType
{
    public function __construct(
        public array $response,
        public bool $collection = false,
        public ?string $description = null,
    ) {
    }
}
