<?php

namespace App\SharedKernel\Contracts\Domains;

interface OfficeOpeningHourDomainContract
{

    public function isOfficeOpen(array $attributes): bool;
}
