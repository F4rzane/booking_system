<?php

namespace App\Domains\Booking\Tests;

use App\Models\Employee\Employee;
use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class CreateBookingTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_create_bookings()
    {

        EntityType::factory()->create();
        $employee = Employee::factory()->create();
        $entity   = Entity::factory()->create();

        $correctData = [
            'employee_id' => $employee->id,
            'entity_id' => $entity->id,
            'start_time' => '15:00:00',
            'end_time' => '16:00:00',
            'day' => '2022-04-26'
        ];

        $this->post(route('bookings.create'), $correctData)
            ->assertStatus(Response::HTTP_OK);
    }
}
