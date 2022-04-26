<?php

namespace App\Domains\Booking\Actions;

use App\SharedKernel\Actions\Resources\AbstractListAction;

use App\SharedKernel\DTOs\Booking\BookingDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Booking\Contracts\BookingRepositoryContract;

#[ResponseType(response: ['employee' => BookingDTO::class], collection: true, description: 'employees list')]
class ListBookingAction extends AbstractListAction
{
    protected string $resourceName = 'employee';

    protected array $relations = [];

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
