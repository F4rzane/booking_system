<?php


use App\Domains\Entity\Facility\Actions\CreateFacilityAction;
use App\Domains\Entity\Facility\Actions\DeleteFacilityAction;
use App\Domains\Entity\Facility\Actions\ListFacilityAction;
use App\Domains\Entity\Facility\Actions\ReadFacilityAction;
use App\Domains\Entity\Facility\Actions\UpdateFacilityAction;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::put('/facilities/{entityId}', UpdateFacilityAction::class)->name('facilities.update');
    Route::get('/facilities/{entityId}', ReadFacilityAction::class)->name('facilities.read');
    Route::delete('/facilities/{entityId}', DeleteFacilityAction::class)->name('facilities.delete');
    Route::post('/facilities/', CreateFacilityAction::class)->name('facilities.create');
    Route::get('/facilities', ListFacilityAction::class)->name('facilities.list');
});
