<?php

namespace App\Domains\Entity\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class CreateEntityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_create_entities()
    {
        $entityType   = EntityType::factory()->make();

        $data = [
            'entity_type_id' => $entityType->id,
            'name' => 'Desk',
            'description' => '',
        ];

        $this->post(route('entities.create'),$data)
            ->assertStatus(Response::HTTP_OK);


    }
}
