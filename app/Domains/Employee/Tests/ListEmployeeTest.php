<?php

namespace App\Domains\Employee\Tests;

use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Admin\Admin;
use App\Models\Account\User;
use App\Models\Clinic\Employee;
use Symfony\Component\HttpFoundation\Response;

class ListEmployeeTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_list_employees()
    {
        \App\Models\Employee\Employee::factory()->make();

        $this->get(route('employees.list'))
            ->assertStatus(Response::HTTP_OK);
    }
}
