<?php

namespace App\Domains\Employee;

use Illuminate\Support\ServiceProvider;

use App\Domains\Employee\Repositories\EmployeeRepository;
use App\Domains\Employee\Contracts\EmployeeRepositoryContract;

use Illuminate\Support\Facades\Route;

class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepositoryContract::class, EmployeeRepository::class);
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
            ->group(app_path('Domains/Employee/routes/api.php'));
    }
}
