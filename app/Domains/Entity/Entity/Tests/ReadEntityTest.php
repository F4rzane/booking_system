<?php

namespace App\Domains\Entities\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class ReadEntitiesTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_read_entities()
    {
        EntityType::factory()->make();
        $entity = Entity::factory()->make();

        $this->get(route('entities.delete'),[$entity->id])
            ->assertStatus(Response::HTTP_OK);
    }
}
