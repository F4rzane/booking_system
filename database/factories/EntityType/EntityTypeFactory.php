<?php

namespace Database\Factories\EntityType;

use App\Models\Employee\Employee;
use App\Models\EntityType\EntityType;
use Illuminate\Database\Eloquent\Factories\Factory;


use App\SharedKernel\Constants\ClinicConstants;

class EntityTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EntityType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->userName(),
        ];
    }

}
