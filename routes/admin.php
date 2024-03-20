<?php
use App\Http\Controllers\CityController;
use App\Http\Controllers\WorkerController;

Route::middleware('role:admin')->name('admin.')->group(function () {
    Route::get('/workers', [WorkerController::class, 'index'])->name('workers.index');
    Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
});