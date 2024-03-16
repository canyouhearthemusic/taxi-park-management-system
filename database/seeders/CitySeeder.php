<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'name' => 'Алматы',
                'region' => 2
            ],
            [
                'name' => 'Караганда',
                'region' => 9
            ],
            [
                'name' => 'Кызылорда',
                'region' => 11
            ],
            [
                'name' => 'Петропавловск',
                'region' => 15
            ],
        ];
        
        City::insert($cities);
    }
}
