<?php

namespace App\Actions\Cars;

use App\Models\Car;

class DeleteCar
{
    public function handle(Car $car)
    {
        return $car->deleteOrFail();
    }
}