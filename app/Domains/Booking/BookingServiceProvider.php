<?php

namespace App\Domains\Booking;

use App\Domains\Booking\Contracts\HolidayRepositoryContract;
use App\Domains\Booking\Contracts\OfficeOpeningHourRepositoryContract;
use App\Domains\Booking\Repositories\HolidayRepository;
use App\Domains\Booking\Repositories\OfficeOpeningHourRepository;
use Illuminate\Support\ServiceProvider;

use App\Domains\Booking\Repositories\BookingRepository;
use App\Domains\Booking\Contracts\BookingRepositoryContract;

use Illuminate\Support\Facades\Route;

class BookingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookingRepositoryContract::class, BookingRepository::class);
        $this->app->bind(HolidayRepositoryContract::class, HolidayRepository::class);
        $this->app->bind(OfficeOpeningHourRepositoryContract::class, OfficeOpeningHourRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(app_path('Domains/Booking/routes/api.php'));
    }
}
