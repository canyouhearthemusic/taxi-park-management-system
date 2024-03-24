<?php

namespace App\Http\Controllers;

use App\Actions\Workers\CreateNewWorker;
use App\Enums\UserRole;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Resources\UserResource;
use App\Models\City;
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

    public function create()
    {
        return Inertia::render('Admin/Workers/Create', [
            'roles' => UserRole::options(),
            'cities' => City::select(['id', 'name'])->get()
        ]);
    }

    public function store(StoreWorkerRequest $request, CreateNewWorker $createNewWorker)
    {
        $user = $createNewWorker->handle($request);

        if($user) {
            return to_route('admin.workers.index')->with(['success' => 'Работник был успешно создан.']);
        }

        return to_route('admin.workers.index')->with(['error' => 'Не удалось создать работника']);
    }
}