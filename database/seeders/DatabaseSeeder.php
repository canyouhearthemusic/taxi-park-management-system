<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            CitySeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Main Admin',
            'role' => UserRole::ADMIN->value,
            'email' => 'admin@example.com',
            'password' => 'pass1234'
        ]);
    }
}
