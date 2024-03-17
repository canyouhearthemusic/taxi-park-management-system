<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkerController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Workers/Index', [
            'users' => UserResource::collection(User::query()
                ->with('city')
                ->paginate(15))
                ->withQueryString()
        ]);
    }
}
