<?php

namespace App\Http\Controllers;

use App\Actions\Drivers\CreateDriver;
use App\Actions\Drivers\DeleteDriver;
use App\Actions\Drivers\UpdateDriver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\City;
use App\Models\Driver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Operator/Drivers/Index', [
            'drivers' => Driver::query()
                ->select(['drivers.id', 'drivers.name', 'drivers.IIN', 'cities.name as city_name'])
                ->leftJoin('cities', 'cities.id', '=', 'drivers.city_id')
                ->when($request->query('search'), fn($query, $text) => $query->searchBy('drivers.name', $text))
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
        return Inertia::render('Operator/Drivers/Create', [
            'cities' => City::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request, CreateDriver $action)
    {
        return $action->handle($request)
            ? to_route('operator.drivers.index')->with(['success' => 'Водитель был успешно создан'])
            : to_route('operator.drivers.index')->with(['error' => 'Не удалось создать Водителя']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return Inertia::render('Operator/Drivers/Edit', [
            'driver' => $driver,
            'cities' => City::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, UpdateDriver $action, Driver $driver)
    {
        return $action->handle($request, $driver)
            ? to_route('operator.drivers.index')->with(['success' => 'Водитель был успешно обновлен'])
            : to_route('operator.drivers.index')->with(['error' => 'Не удалось обновить Водителя']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver, DeleteDriver $action)
    {
        return $action->handle($driver)
            ? to_route('operator.drivers.index')->with(['success' => 'Водитель был успешно обновлен'])
            : to_route('operator.drivers.index')->with(['error' => 'Не удалось обновить Водителя']);
    }
}
