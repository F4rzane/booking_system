<?php

namespace Database\Factories\Employee;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;


use App\SharedKernel\Constants\ClinicConstants;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'user_name' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'mobile' => $this->faker->phoneNumber(),
        ];
    }

}
