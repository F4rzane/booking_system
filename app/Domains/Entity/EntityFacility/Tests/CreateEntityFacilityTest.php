<?php

namespace App\Domains\EntityFacility\Tests;

use App\Models\Entity\Entity;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class CreateEntityFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_create_entitiy_facilities()
    {
        $entity = Entity::factory()->make();
        $facility = Facility::factory()->make();
        $data = [
            'entity_id' => $entity->id,
            'facility_id' => $facility->id
        ];

        $this->post(route('entity-facility.create'), $data)
            ->assertStatus(Response::HTTP_OK);
    }
}
