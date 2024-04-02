<?php
use App\Http\Controllers\CarController;
use App\Http\Controllers\DriverController;

Route::middleware('role:operator')->name('operator.')->group(function () {
    Route::resource('drivers', DriverController::class);

    Route::resource('cars', CarController::class);
});