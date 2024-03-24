<?php
use App\Http\Controllers\CityController;
use App\Http\Controllers\WorkerController;

Route::middleware('role:admin')->name('admin.')->group(function () {
    Route::resource('workers', WorkerController::class)->only(['index', 'create', 'store']);

    Route::resource('cities', CityController::class)->only(['index', 'create', 'store']);
});