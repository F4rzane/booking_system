<?php

namespace App\Domains\Entity\Tests;

use App\Models\Booking\Booking;
use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class DeleteEntityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_delete_entities()
    {
        EntityType::factory()->make();
        $entity = Entity::factory()->make();

        $this->delete(route('entities.delete'),[$entity->id])
            ->assertStatus(Response::HTTP_OK);
    }
}
