<?php

namespace App\Domains\Booking\Tests;

use App\Models\Booking\Booking;
use App\Models\Employee\Employee;
use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class DeleteBookingTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_delete_bookings()
    {
        Employee::factory()->create();
        EntityType::factory()->create();
        Entity::factory()->create();
        $booking = Booking::factory()->create();

        $this->delete(route('bookings.delete', ['bookingId' => $booking->id]))
            ->assertStatus(Response::HTTP_OK);
    }
}
