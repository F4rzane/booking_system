<?php

namespace Database\Factories\Booking;

use App\Models\Booking\Booking;
use App\Models\Employee\Employee;
use App\Models\Entity\Entity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;


use App\SharedKernel\Constants\ClinicConstants;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

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
        $employee = Employee::query()
            ->get()
            ->pluck('id')
            ->toArray();
        return [
            'entity_id' => $this->faker->randomElement($entity),
            'employee_id' => $this->faker->randomElement($employee),
            'day' => Carbon::now()->format('Y-m-d'),
            'start_time' => '15:00:00',
            'end_time' => '17:00:00',
        ];
    }

}
