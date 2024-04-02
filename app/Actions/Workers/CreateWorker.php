<?php

namespace App\Actions\Workers;

use App\Models\User;
use Illuminate\Http\Request;

class CreateWorker
{
    public function handle(Request $request)
    {
        return User::factory()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'city_id' => $request->city,
            'role' => $request->role
        ]);
    }
}