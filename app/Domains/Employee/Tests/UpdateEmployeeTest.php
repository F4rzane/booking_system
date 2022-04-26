<?php

namespace App\Domains\Employee\Tests;

use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Admin\Admin;
use App\Models\Clinic\Employee;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UpdateEmployeeTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_update_employee()
    {
        $employee = \App\Models\Employee\Employee::factory()->create();
        $data = [
            'name' => 'Farzane',
            'user_name' => 'F.khazaei',
            'email' => 'ms.khazaei007@gmail.com',
            'mobile' => '9122983203'
        ];

        $this->put(route('employees.update', ['employeeId' => $employee->id]), $data)
            ->assertStatus(Response::HTTP_OK);
    }
}
