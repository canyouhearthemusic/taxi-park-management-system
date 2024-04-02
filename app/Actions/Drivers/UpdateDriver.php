<?php

namespace App\Actions\Drivers;

use App\Models\Driver;
use Illuminate\Http\Request;

class UpdateDriver
{
    public function handle(Request $request, Driver $driver)
    {
        return $driver->update([
            'name' => $request->name,
            'IIN' => $request->IIN,
            'city_id' => $request->city,
        ]);
    }
}