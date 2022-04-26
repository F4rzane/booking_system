<?php

namespace App\Domains\Booking\Tests;

use App\Models\Booking\Booking;
use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class ListBookingTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_list_bookings()
    {
        \App\Models\Employee\Employee::factory()->create();
        EntityType::factory()->make();
        Entity::factory()->make();
        Booking::factory()->make();

        $this->get(route('bookings.list'))
            ->assertStatus(Response::HTTP_OK);

    }
}
