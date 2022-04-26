<?php

namespace App\Domains\EntityType\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class CreateEntityTypeTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_update_entity_types()
    {
        $entityType = EntityType::factory()->make();
        $data = [
            'name' => 'Desk',
            'description' => ''
        ];

        $this->put(route('entity-types.create'), $entityType->id, $data)
            ->assertStatus(Response::HTTP_OK);
    }
}
