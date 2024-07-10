<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'India'],
            ['name' => 'United States'],
            ['name' => 'China'],
            ['name' => 'Brazil'],
            ['name' => 'Russia'],
            ['name' => 'France'],
            ['name' => 'Germany'],
            ['name' => 'Japan'],
            ['name' => 'United Kingdom'],
            ['name' => 'Canada'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
