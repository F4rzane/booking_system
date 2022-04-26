<?php

namespace App\Domains\Booking\Actions;

use App\SharedKernel\Actions\Resources\AbstractDeleteAction;

use App\SharedKernel\DTOs\Booking\BookingDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Booking\Contracts\BookingRepositoryContract;

#[ResponseType(response: [], description: 'delete booking')]
class DeleteBookingAction extends AbstractDeleteAction
{
    protected string $resourceName = 'booking';

    protected function getDTO(): string
    {
        return BookingDTO::class;
    }

    public function __construct(
        BookingRepositoryContract $repository,
    ) {
        $this->repository = $repository;
    }
}
