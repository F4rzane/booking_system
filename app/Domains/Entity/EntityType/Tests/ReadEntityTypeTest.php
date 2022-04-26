<?php

namespace App\Domains\EntityType\Tests;

use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;


use Symfony\Component\HttpFoundation\Response;

class DeleteEntityFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_read_entity_types()
    {
        $entityType = EntityType::factory()->make();
        $this->get(route('entity-types.delete'),$entityType->id)
            ->assertStatus(Response::HTTP_OK);
    }
}
