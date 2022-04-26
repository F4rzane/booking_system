<?php

namespace App\Domains\EntityFacility\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityFacility\EntityFacility;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;


use Symfony\Component\HttpFoundation\Response;

class UpdateEntityFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_update_entity_facilities()
    {
        $entity = Entity::factory()->make();
        $facility = Facility::factory()->make();
        $entityFacility = EntityFacility::factory()->make();

        $data = [
            'entity_id' => $entity->id,
            'facility_id' => $facility->id
        ];

        $this->put(route('entity-facility.update'), $data)
            ->assertStatus(Response::HTTP_OK);
    }
}
