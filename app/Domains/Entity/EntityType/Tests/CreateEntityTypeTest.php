<?php

namespace App\Domains\EntityType\Tests;

use App\Models\Entity\Entity;
use App\Models\Facility\Facility;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class CreateEntityTypeTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_create_entity_types()
    {
        $data = [
            'name' => 'Desk',
            'description' => ''
        ];

        $this->post(route('entity-types.create'), $data)
            ->assertStatus(Response::HTTP_OK);
    }
}
