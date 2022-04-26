<?php

namespace Database\Factories\Facility;

use App\Models\Employee\Employee;
use App\Models\EntityType\EntityType;
use App\Models\FacilityType\FacilityType;
use Illuminate\Database\Eloquent\Factories\Factory;


use App\SharedKernel\Constants\ClinicConstants;

class FacilityFactory extends Factory
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
        $entityType = EntityType::query()
            ->get()
            ->pluck('id')
            ->toArray();
        return [
            'entity_type_id' => $this->faker->randomElement($entityType),
            'name' => $this->faker->name(),
            'description' => $this->faker->userName(),
        ];
    }

}
