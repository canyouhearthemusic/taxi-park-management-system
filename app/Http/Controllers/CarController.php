<?php

namespace App\Http\Controllers;

use App\Actions\Cars\CreateCar;
use App\Actions\Cars\DeleteCar;
use App\Actions\Cars\UpdateCar;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\City;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Operator/Cars/Index', [
            'cars' => Car::query()
                ->select(['cars.id', 'cars.firm', 'cars.model', 'cars.license_plate', 'cities.name as city_name'])
                ->join('cities', 'cities.id', '=', 'cars.city_id')
                ->when($request->query('search'), fn($query, $text) => $query->searchBy('cars.license_plate', $text))
                ->when($request->query('sort'), fn($query, $sort) => $query->sortBy($sort))
                ->paginate(15)
                ->withQueryString(),
            'search' => $request->query('search', ''),
            'sort' => $request->query('sort', ''),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Operator/Cars/Create', [
            'cities' => City::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request, CreateCar $action)
    {
        return $action->handle($request)
            ? to_route('operator.cars.index')->with(['success' => 'Водитель был успешно создан'])
            : to_route('operator.cars.index')->with(['error' => 'Не удалось создать Водителя']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return Inertia::render('Operator/Cars/Edit', [
            'car' => $car,
            'cities' => City::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, UpdateCar $action, Car $car)
    {
        return $action->handle($request, $car)
            ? to_route('operator.cars.index')->with(['success' => 'Машина была успешно обновлена'])
            : to_route('operator.cars.index')->with(['error' => 'Не удалось обновить машину']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car, DeleteCar $action)
    {
        return $action->handle($car)
            ? to_route('operator.cars.index')->with(['success' => 'Машина была успешно удалена'])
            : to_route('operator.cars.index')->with(['error' => 'Не удалось удалить Машину']);
    }
}
