<?php

Route::middleware('role:admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
         echo '123';
    });
});
