<?php

namespace App\Domains\Booking\Repositories;

use App\Domains\Booking\Contracts\HolidayRepositoryContract;
use App\Models\Holiday\Holiday;
use App\SharedKernel\Repositories\BaseRepository;

class HolidayRepository extends BaseRepository implements HolidayRepositoryContract
{
    public function model() : string
    {
        return Holiday::class;
    }
}
