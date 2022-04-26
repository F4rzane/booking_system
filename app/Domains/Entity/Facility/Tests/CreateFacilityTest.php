<?php

namespace App\Domains\Facility\Tests;

use App\Models\EntityType\EntityType;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class CreateFacilityTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_create_facility()
    {
        $entityType   = EntityType::factory()->make();

        $data = [
            'entity_type_id' => $entityType->id,
            'name' => 'Desk',
            'description' => '',
        ];

        $this->post(route('facilities.create'),$data)
            ->assertStatus(Response::HTTP_OK);


    }
}
