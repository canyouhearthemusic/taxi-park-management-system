<?php

namespace App\Actions\Drivers;

use App\Models\Driver;
use Illuminate\Http\Request;

class CreateDriver
{
    public function handle(Request $request)
    {
        $request->user()->drivers()->create([
            'name' => $request->name,
            'IIN' => $request->IIN,
            'city_id' => $request->city,
        ]);
    }
}