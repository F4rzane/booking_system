<?php

namespace App\Domains\Employee\Tests;

use App\Models\Employee\Employee;
use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\Response;

class DeleteEmployeeTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_delete_employees()
    {
        $employee = Employee::factory()->create();

        $this->delete(route('employees.delete', ['employeeId' => $employee->id]))
            ->assertStatus(Response::HTTP_OK);

    }
}
