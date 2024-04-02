<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\WorkerController;

Route::middleware('role:admin')->name('admin.')->group(function () {
    Route::resource('workers', WorkerController::class)->parameters(['workers' => 'user']);

    Route::resource('cities', CityController::class);
});