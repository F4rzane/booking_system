<?php

namespace App\Domains\Facilities\Tests;

use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class ReadEntitiesTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_create_facilities()
    {
        EntityType::factory()->make();
        $facility = Facility::factory()->make();

        $this->get(route('facilities.read'),[$facility->id])
            ->assertStatus(Response::HTTP_OK);
    }
}
