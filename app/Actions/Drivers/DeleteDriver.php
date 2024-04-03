<?php

namespace App\Actions\Drivers;

use App\Models\Driver;

class DeleteDriver
{
    public function handle(Driver $driver)
    {
        return $driver->deleteOrFail();
    }
}