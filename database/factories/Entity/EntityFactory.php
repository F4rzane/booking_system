<?php

namespace Database\Factories\Entity;

use App\Models\Employee\Employee;
use App\Models\Entity\Entity;
use App\Models\EntityType\EntityType;
use Illuminate\Database\Eloquent\Factories\Factory;


use App\SharedKernel\Constants\ClinicConstants;

class EntityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entity::class;

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
            'max_simultaneous_booking' => null,
            'available_in_holidays' => true,
        ];
    }

}
