<?php

namespace App\Domains\Entity\Entity;

use Illuminate\Support\ServiceProvider;

use App\Domains\Entity\Entity\Repositories\EntityRepository;
use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;

use Illuminate\Support\Facades\Route;

class EntityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EntityRepositoryContract::class, EntityRepository::class);
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
            ->group(app_path('Domains/Entity/Entity/routes/api.php'));
    }
}
