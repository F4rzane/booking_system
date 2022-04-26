<?php

namespace App\SharedKernel\Traits;

use Lorisleiva\Actions\Concerns\WithAttributes as BaseWithAttributes;

use App\SharedKernel\Services\DataBag;

trait WithAttributes
{
    use BaseWithAttributes {
        validateAttributes as baseValidateAttributes;
    }

    protected DataBag $validatedAttributes;

    public function validateAttributes(): array
    {
        $validatedAttributes = $this->baseValidateAttributes();

        $this->validatedAttributes = new DataBag($validatedAttributes);

        return $validatedAttributes;
    }

    public function safe(): DataBag
    {
        return $this->validatedAttributes ?? new DataBag();
    }

    public function setValidatedAttributes(array $validatedAttributes): self
    {
        $this->validatedAttributes = new DataBag($validatedAttributes);

        return $this;
    }
}
