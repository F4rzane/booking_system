<?php

namespace App\Domains\Entity\EntityType;

use Illuminate\Support\ServiceProvider;

use App\Domains\Entity\EntityType\Repositories\EntityTypeRepository;
use App\Domains\Entity\EntityType\Contracts\EntityTypeRepositoryContract;

use Illuminate\Support\Facades\Route;

class EntityTypeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EntityTypeRepositoryContract::class, EntityTypeRepository::class);
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
            ->group(app_path('Domains/Entity/EntityType/routes/api.php'));
    }
}
