<?php

namespace App\Domains\Booking\Actions;

use App\SharedKernel\Actions\Resources\AbstractReadAction;

use App\SharedKernel\DTOs\Booking\BookingDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Booking\Contracts\BookingRepositoryContract;

#[ResponseType(response: ['booking' => BookingDTO::class], description: 'Read booking')]
class ReadBookingAction extends AbstractReadAction
{
    protected string $resourceName = 'booking';

    protected bool $authority = true;

    protected bool $public = true;

    protected function getDTO(): string
    {
        return BookingDTO::class;
    }

    public function __construct(BookingRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
