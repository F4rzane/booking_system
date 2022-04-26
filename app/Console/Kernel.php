<?php

namespace App\Console;

use App\Console\Commands\AccountDoctorConsumerCommand;
use App\Console\Commands\SmsAppointmentNotification;
use App\Console\Commands\SmsDayAppointmentsCount;
use App\Console\Commands\SmsDayAppointmentsDetailList;
use App\Console\Commands\SyncAppointmentTitleSetting;
use App\Console\Commands\SyncBaseSetting;
use App\Console\Commands\SyncDoctorAppointmentTitleIds;
use App\Console\Commands\SyncSmsSetting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
