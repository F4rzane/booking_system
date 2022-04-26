<?php

namespace Database\Seeders;

use App\Models\OfficeOpeningHours\OfficeOpeningHours;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OfficeOpeningHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'day' => '1',
                'start_time' => '9:00:00',
                'end_time' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'day' => '2',
                'start_time' => '9:00:00',
                'end_time' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'day' => '3',
                'start_time' => '9:00:00',
                'end_time' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'day' => '4',
                'start_time' => '9:00:00',
                'end_time' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'day' => '5',
                'start_time' => '9:00:00',
                'end_time' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        OfficeOpeningHours::query()
            ->insert($attributes);
    }
}
