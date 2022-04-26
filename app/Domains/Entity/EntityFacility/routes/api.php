<?php

use App\Domains\Entity\EntityFacility\Actions\CreateEntityFacilityAction;
use App\Domains\Entity\EntityFacility\Actions\DeleteEntityFacilityAction;
use App\Domains\Entity\EntityFacility\Actions\ListEntityFacilityAction;
use App\Domains\Entity\EntityFacility\Actions\ReadEntityFacilityAction;
use App\Domains\Entity\EntityFacility\Actions\UpdateEntityFacilityAction;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'v1'
], function () {
    Route::put('/entity-facility/{entityFacilityId}', UpdateEntityFacilityAction::class)->name('entity-types.update');
    Route::get('/entity-facility/{entityFacilityId}', ReadEntityFacilityAction::class)->name('entity-types.read');
    Route::delete('/entity-facility/{entityFacilityId}', DeleteEntityFacilityAction::class)->name('entity-types.delete');
    Route::post('/entity-facility/', CreateEntityFacilityAction::class)->name('entity-types.create');
    Route::get('/entity-facility', ListEntityFacilityAction::class)->name('entity-types.list');
});
