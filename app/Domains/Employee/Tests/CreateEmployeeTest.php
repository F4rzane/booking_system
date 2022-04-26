<?php

namespace App\Domains\Employee\Tests;

use App\SharedKernel\Tests\HttpTestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Admin\Admin;
use App\Models\Clinic\Employee;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CreateEmployeeTest extends HttpTestCase
{
    use DatabaseTransactions;

    public function test_create_employees()
    {
        $this->post(route('employees.create'), [])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $data = [
            'name' => 'Farzane',
            'user_name' => 'F.khazaei',
            'email' => 'ms.khazaei007@gmail.com',
            'mobile' => '9122983203'
        ];

        $this->post(route('employees.create'), $data)
            ->assertStatus(Response::HTTP_OK);

        $duplicateData = [
            'name' => 'Farzane',
            'user_name' => 'F.khazaei',
            'email' => 'ms.khazaei007@gmail.com',
            'mobile' => '9122983203'
        ];

        $this->post(route('employees.create'), $duplicateData)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }
}
