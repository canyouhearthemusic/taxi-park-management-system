<?php

namespace App\Http\Controllers;

use App\Actions\Jetstream\DeleteUser;
use App\Actions\Workers\UpdateWorker;
use App\Actions\Workers\CreateWorker;
use App\Enums\UserRole;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
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
                ->with('city:id,name')
                ->withCount('drivers')
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

    public function store(StoreWorkerRequest $request, CreateWorker $action)
    {
        return $action->handle($request)
            ? to_route('admin.workers.index')->with(['success' => 'Работник был успешно создан.'])
            : to_route('admin.workers.index')->with(['error' => 'Не удалось создать работника']);
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Workers/Edit', [
            'worker' => UserResource::make($user),
            'roles' => UserRole::options(),
            'cities' => City::select(['id', 'name'])->get()
        ]);
    }

    public function update(UpdateWorkerRequest $request, UpdateWorker $action, User $user)
    {
        return $action->handle($request, $user)
            ? to_route('admin.workers.index')->with(['success' => 'Работник был успешно обновлен.'])
            : to_route('admin.workers.index')->with(['error' => 'Не удалось обновить работника']);
    }

    public function destroy(User $user, DeleteUser $action)
    {
        return $action->delete($user)
            ? to_route('admin.workers.index')->with(['success' => 'Работник был успешно удален.'])
            : to_route('admin.workers.index')->with(['error' => 'Не удалось удалить работника']);
    }
}