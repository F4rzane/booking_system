<?php

namespace App\Domains\Entity\EntityFacility;

use App\Domains\Entity\EntityFacility\Repositories\EntityFacilityRepository;
use App\Domains\Entity\EntityFacility\Contracts\EntityFacilityRepositoryContract;
use Illuminate\Support\ServiceProvider;


use Illuminate\Support\Facades\Route;

class EntityFacilityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EntityFacilityRepositoryContract::class, EntityFacilityRepository::class);
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
            ->group(app_path('Domains/Entity/EntityFacility/routes/api.php'));
    }
}
