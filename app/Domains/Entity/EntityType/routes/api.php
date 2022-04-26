<?php


use App\Domains\Entity\EntityType\Actions\CreateEntityTypeAction;
use App\Domains\Entity\EntityType\Actions\DeleteEntityTypeAction;
use App\Domains\Entity\EntityType\Actions\ListEntityTypeAction;
use App\Domains\Entity\EntityType\Actions\ReadEntityTypeAction;
use App\Domains\Entity\EntityType\Actions\UpdateEntityTypeAction;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::put('/entity-types/{entityTypeId}', UpdateEntityTypeAction::class)->name('entity-types.update');
    Route::get('/entity-types/{entityTypeId}', ReadEntityTypeAction::class)->name('entity-types.read');
    Route::delete('/entity-types/{entityTypeId}', DeleteEntityTypeAction::class)->name('entity-types.delete');
    Route::post('/entity-types/', CreateEntityTypeAction::class)->name('entity-types.create');
    Route::get('/entity-types', ListEntityTypeAction::class)->name('entity-types.list');
});
