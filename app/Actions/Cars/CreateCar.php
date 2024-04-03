<?php

namespace App\Actions\Cars;

use Illuminate\Http\Request;

class CreateCar
{
    public function handle(Request $request)
    {
        $request->user()->cars()->create([
            'firm' => $request->firm,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'city_id' => $request->city,
        ]);
    }
}