<?php

namespace App\Domains\Entity\Tests;

use App\Models\Booking\Booking;
use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class ListEntitysTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_list_entities()
    {
        EntityType::factory()->make();
        Entity::factory()->make();

        $this->get(route('entities.list'))
            ->assertStatus(Response::HTTP_OK);
    }
}
