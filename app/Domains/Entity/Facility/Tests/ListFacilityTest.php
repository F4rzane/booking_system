<?php

namespace App\Domains\Facility\Tests;

use App\Models\Booking\Booking;
use App\Models\EntityType\EntityType;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class ListFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_list_facilities()
    {
        EntityType::factory()->make();
        Facility::factory()->make();

        $this->get(route('facilities.list'))
            ->assertStatus(Response::HTTP_OK);
    }
}
