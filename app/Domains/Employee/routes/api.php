<?php

use App\Domains\Employee\Actions\CreateEmployeeAction;
use App\Domains\Employee\Actions\DeleteEmployeeAction;
use App\Domains\Employee\Actions\UpdateEmployeeAction;
use Illuminate\Support\Facades\Route;
use App\Domains\Employee\Actions\ReadEmployeeAction;
use App\Domains\Employee\Actions\ListEmployeeAction;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::put('/employees/{employeeId}', UpdateEmployeeAction::class)->name('employees.update');
    Route::get('/employees/{employeeId}', ReadEmployeeAction::class)->name('employees.read');
    Route::delete('/employees/{employeeId}', DeleteEmployeeAction::class)->name('employees.delete');
    Route::post('/employees/', CreateEmployeeAction::class)->name('employees.create');
    Route::get('/employees', ListEmployeeAction::class)->name('employees.list');
});
