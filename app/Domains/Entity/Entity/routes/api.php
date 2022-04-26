<?php


use App\Domains\Entity\Entity\Actions\CreateEntityAction;
use App\Domains\Entity\Entity\Actions\DeleteEntityAction;
use App\Domains\Entity\Entity\Actions\ListEntityAction;
use App\Domains\Entity\Entity\Actions\ReadEntityAction;
use App\Domains\Entity\Entity\Actions\UpdateEntityAction;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::put('/entities/{entityId}', UpdateEntityAction::class)->name('entities.update');
    Route::get('/entities/{entityId}', ReadEntityAction::class)->name('entities.read');
    Route::delete('/entities/{entityId}', DeleteEntityAction::class)->name('entities.delete');
    Route::post('/entities/', CreateEntityAction::class)->name('entities.create');
    Route::get('/entities', ListEntityAction::class)->name('entities.list');
});
