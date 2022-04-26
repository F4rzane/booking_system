<?php

namespace App\Domains\Clinic\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class UpdateFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_update_facilities()
    {
        $entityType   = EntityType::factory()->make();
        $facility = Entity::factory()->make();

        $data = [
            'entity_type_id' => $entityType->id,
            'name' => 'Desk',
            'description' => '',
        ];

        $this->put(route('facilities.update'),$facility->id, $data)
            ->assertStatus(Response::HTTP_OK);
    }
}
