<?php

namespace App\SharedKernel\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\SharedKernel\Contracts\Domains\EntityDomainContract;

class EntityExists implements Rule
{
    /**
     * Create a new in rule instance.
     *
     * @param  EntityDomainContract  $entityDomain
     * @return void
     */
    public function __construct(protected EntityDomainContract $entityDomain)
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!is_int($value)) {
            return false;
        }

        return $this->entityDomain->entityExists(['id' => $value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.exists');
    }
}
