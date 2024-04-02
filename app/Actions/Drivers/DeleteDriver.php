<?php

namespace App\Actions\Drivers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DeleteDriver
{
    public function handle(Driver $driver)
    {
        return $driver->deleteOrFail();
    }
}