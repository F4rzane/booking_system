<?php

namespace App\Domains\Employee\Tests;

use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Admin\Admin;
use App\Models\Account\User;
use App\Models\Clinic\Employee;
use Symfony\Component\HttpFoundation\Response;

class ReadEmployeeTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_read_employees()
    {
        $employee = \App\Models\Employee\Employee::factory()->create();

        $this->get(route('employees.read', ['employeeId' => $employee->id]))
            ->assertStatus(Response::HTTP_OK);
    }
}
