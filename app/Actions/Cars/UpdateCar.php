<?php

namespace App\Actions\Cars;

use App\Models\Car;
use Illuminate\Http\Request;

class UpdateCar
{
    public function handle(Request $request, Car $car)
    {
        return $car->update([
            'firm' => $request->firm,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'city_id' => $request->city,
        ]);
    }
}