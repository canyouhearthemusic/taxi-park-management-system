<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Admin/Workers/Index', [
            'users' => UserResource::collection(User::query()
                ->with('city')
                ->when($request->query('search'), fn($query, $text) => $query->searchBy('name', $text))
                ->when($request->query('sort'), fn($query, $sort) => $query->sortBy($sort))
                ->paginate(15))
                ->withQueryString(),
            'search' => $request->query('search', ''),
            'sort' => $request->query('sort', ''),
        ]);
    }
}