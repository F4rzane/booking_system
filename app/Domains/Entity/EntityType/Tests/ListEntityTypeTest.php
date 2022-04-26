<?php

namespace App\Domains\EntityType\Tests;

use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;


use Symfony\Component\HttpFoundation\Response;

class ListEntityFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_list_entity_types()
    {
        EntityType::factory()->make();
        $this->delete(route('entity-types.list'))
            ->assertStatus(Response::HTTP_OK);
    }
}
