<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Validator;

class CityController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Admin/Cities/Index', [
            'cities' => City::query()
                ->when($request->query('search'), fn($query, $text) => $query->searchBy('name', $text))
                ->paginate()
                ->withQueryString(),
            'search' => $request->query('search', '')
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Cities/Create');
    }

    public function store(StoreCityRequest $request)
    {
        $data = $request->validated();

        City::create($data);

        return to_route('admin.cities.index')->with(['success' => 'Город был успешно создан.']);
    }

    public function edit(City $city)
    {
        return Inertia::render('Admin/Cities/Edit', [
            'city' => $city
        ]);
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        return $city->update($request->validated())
            ? to_route('admin.cities.index')->with(['success' => 'Работник был успешно обновлен.'])
            : to_route('admin.cities.index')->with(['error' => 'Не удалось обновить работника']);
    }

    public function destroy(City $city)
    {
        return $city->delete()
            ? to_route('admin.cities.index')->with(['success' => 'Город был успешно удален.'])
            : to_route('admin.cities.index')->with(['error' => 'Не удалось удалить город']);
    }
}