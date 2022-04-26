<?php

namespace App\Domains\EntityFacility\Tests;

use App\Models\Entity\Entity;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class ListEntityFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_list_entity_facilities()
    {
        $entity = Entity::factory()->make();
        $facility = Facility::factory()->make();

        $this->get(route('entity-facility.list'))
            ->assertStatus(Response::HTTP_OK);
    }
}
