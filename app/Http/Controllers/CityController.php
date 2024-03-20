<?php

namespace App\Http\Controllers;

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
}
