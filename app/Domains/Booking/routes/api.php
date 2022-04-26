<?php

use App\Domains\Booking\Actions\CreateBookingAction;
use App\Domains\Booking\Actions\DeleteBookingAction;
use Illuminate\Support\Facades\Route;
use App\Domains\Booking\Actions\ReadBookingAction;
use App\Domains\Booking\Actions\ListBookingAction;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::get('/bookings/{bookingId}', ReadBookingAction::class)->name('bookings.read');
    Route::delete('/bookings/{bookingId}', DeleteBookingAction::class)->name('bookings.delete');
    Route::post('/bookings/', CreateBookingAction::class)->name('bookings.create');
    Route::get('/bookings', ListBookingAction::class)->name('bookings.list');
});
