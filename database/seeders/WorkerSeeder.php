<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(3)->create([
            'role' => UserRole::SECURITY->value,
            'city_id' => 3,
            'password' => 'pass1234'
        ]);

        \App\Models\User::factory(15)->create([
            'role' => UserRole::OPERATOR->value,
            'city_id' => 1,
            'password' => 'pass1234'
        ]);

        \App\Models\User::factory(20)->create([
            'role' => UserRole::OPERATOR->value,
            'city_id' => 2,
            'password' => 'pass1234'
        ]);
    }
}
