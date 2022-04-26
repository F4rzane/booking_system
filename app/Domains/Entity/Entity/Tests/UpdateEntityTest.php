<?php

namespace App\Domains\Clinic\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class UpdateClinicTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_update_entities()
    {
        $entityType   = EntityType::factory()->make();
        $entity = Entity::factory()->make();

        $data = [
            'entity_type_id' => $entityType->id,
            'name' => 'Desk',
            'description' => '',
        ];

        $this->put(route('entities.update'),$entity->id, $data)
            ->assertStatus(Response::HTTP_OK);
    }
}
