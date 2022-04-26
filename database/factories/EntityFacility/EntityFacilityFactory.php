<?php

namespace Database\Factories\EntityFacility;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Entity\Entity;
use App\Models\Facility\Facility;
use App\Models\EntityFacility\EntityFacility;

class EntityFacilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EntityFacility::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $entity = Entity::query()
            ->get()
            ->pluck('id')
            ->toArray();
        $facility = Facility::query()
            ->get()
            ->pluck('id')
            ->toArray();
        return [
            'entity_id' => $this->faker->randomElement($entity),
            'facility_id' => $this->faker->randomElement($facility),
        ];
    }
}
