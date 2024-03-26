<?php

namespace App\Actions\Workers;

use App\Models\User;
use Illuminate\Http\Request;

class UpdateWorker
{
    public function handle(Request $request, User $user)
    {
        return $user->update([
            'name' => $request->name,
            'role' => $request->role,
            'city_id' => $request->city,
        ]);
    }
}