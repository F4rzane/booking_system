<?php

namespace Database\Seeders;

use App\Enums\ENotificationStatus;
use App\Enums\ESettingCategory;
use App\Jobs\AppointmentReminderJob;
use App\Models\DoctorSetting\DoctorSetting;
use App\Models\Education\Education;
use App\Models\NotificationV2\NotificationV2;
use App\Models\Service\Service;
use App\Settings\PatientSmsSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Morilog\Jalali\Jalalian;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(OfficeOpeningHourSeeder::class);
    }
    /**
     * #TODO: check
     * Seed the application's database.
     *
     * @return void
     */

}
