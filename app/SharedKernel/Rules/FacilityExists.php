<?php

namespace App\SharedKernel\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\SharedKernel\Contracts\Domains\FacilityDomainContract;

class FacilityExists implements Rule
{
    /**
     * Create a new in rule instance.
     *
     * @param  FacilityDomainContract  $facilityDomain
     * @return void
     */
    public function __construct(protected FacilityDomainContract $facilityDomain)
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

        return $this->facilityDomain->facilityExists(['id' => $value]);
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
