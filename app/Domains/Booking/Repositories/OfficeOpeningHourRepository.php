<?php

namespace App\Domains\Booking\Repositories;

use App\Domains\Booking\Contracts\OfficeOpeningHourRepositoryContract;
use App\Models\OfficeOpeningHours\OfficeOpeningHours;
use App\SharedKernel\Repositories\BaseRepository;
use Carbon\Carbon;

class OfficeOpeningHourRepository extends BaseRepository implements OfficeOpeningHourRepositoryContract
{
    public function model(): string
    {
        return OfficeOpeningHours::class;
    }
}

