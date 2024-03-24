<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
}
