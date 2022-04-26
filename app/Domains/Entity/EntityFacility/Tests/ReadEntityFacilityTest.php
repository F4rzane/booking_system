<?php

namespace App\Domains\EntityFacility\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityFacility\EntityFacility;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class ReadEntityFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_read_entity_facilities()
    {
        $entity = Entity::factory()->make();
        $facility = Facility::factory()->make();
        $entityFacility = EntityFacility::factory()->make();

        $this->get(route('entity-facility.read'),$entityFacility->id)
            ->assertStatus(Response::HTTP_OK);
    }
}
