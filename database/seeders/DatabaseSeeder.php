<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(JobStatusSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CategorySeeder::class);
    }
}
