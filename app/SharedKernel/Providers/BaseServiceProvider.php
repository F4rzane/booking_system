<?php

namespace App\SharedKernel\Providers;

use Illuminate\Support\ServiceProvider;


use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Contracts\Container\BindingResolutionException;

class BaseServiceProvider extends ServiceProvider
{
    protected array $domains = [
        \App\SharedKernel\Contracts\Domains\EntityFacilityDomainContract::class => \App\Domains\Entity\EntityFacility\Main::class,
        \App\SharedKernel\Contracts\Domains\EntityDomainContract::class => \App\Domains\Entity\Entity\Main::class,
        \App\SharedKernel\Contracts\Domains\FacilityDomainContract::class => \App\Domains\Entity\Facility\Main::class,
        \App\SharedKernel\Contracts\Domains\EmployeeDomainContract::class => \App\Domains\Employee\Main::class,
        \App\SharedKernel\Contracts\Domains\HolidayDomainContract::class => \App\Domains\Booking\MainHoliday::class,
        \App\SharedKernel\Contracts\Domains\OfficeOpeningHourDomainContract::class => \App\Domains\Booking\MainOfficeOpeningHour::class,
    ];
    protected array $rules = [
        'entity_exists' => \App\SharedKernel\Rules\EntityExists::class,
        'facility_exists' => \App\SharedKernel\Rules\FacilityExists::class,
        'employee_exists' => \App\SharedKernel\Rules\EmployeeExists::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->domains as $domainContract => $domainMainEntry) {
            $this->app->singleton($domainContract, function ($app) use ($domainMainEntry) {
                return $app->make($domainMainEntry);
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        Relation::morphMap([
        ]);
        foreach ($this->rules as $rule => $ruleClass) {
            Validator::extend(
                $rule,
                function ($attribute, $value) use ($ruleClass) {
                    return app()->make($ruleClass)->passes($attribute, $value);
                },
                app()->make($ruleClass)->message()
            );
        }

    }
}
