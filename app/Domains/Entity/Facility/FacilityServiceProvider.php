<?php

namespace App\Domains\Entity\Facility;

use App\Domains\Entity\Facility\Contracts\FacilityRepositoryContract;
use App\Domains\Entity\Facility\Repositories\FacilityRepository;
use Illuminate\Support\ServiceProvider;


use Illuminate\Support\Facades\Route;

class FacilityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FacilityRepositoryContract::class, FacilityRepository::class);
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
            ->group(app_path('Domains/Entity/Facility/routes/api.php'));
    }
}
