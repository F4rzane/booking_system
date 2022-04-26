<?php

namespace App\Domains\EntityFacility\Tests;

use App\Models\Entity\Entity;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\EntityFacility\EntityFacility;

use Symfony\Component\HttpFoundation\Response;

class DeleteEntityFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_delete_entity_facilities()
    {
        $entity = Entity::factory()->make();
        $facility = Facility::factory()->make();
        $entityFacility = EntityFacility::factory()->make();


        $this->delete(route('entity-facility.delete'),$entityFacility->id)
            ->assertStatus(Response::HTTP_OK);
    }
}
