<?php

namespace App\Domains\Booking\Tests;

use App\Models\Booking\Booking;
use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class ReadBookingTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_read_bookings()
    {
        \App\Models\Employee\Employee::factory()->create();
        EntityType::factory()->create();
        Entity::factory()->create();
        $booking = Booking::factory()->create();

        $this->get(route('bookings.read', ['bookingId' => $booking->id]))
            ->assertStatus(Response::HTTP_OK);
    }
}
