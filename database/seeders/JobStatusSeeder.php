<?php

namespace Database\Seeders;

use App\Models\JobStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['status' => 'Design'],
            ['status' => 'Press Print'],
            ['status' => 'Ready'],
            ['status' => 'Delivery'],
            ['status' => 'Closed'],
            ['status' => 'Digital Print'],
            ['status' => 'L.F. Print'],
        ];

        foreach ($statuses as $status) {
            JobStatus::create($status);
        }
    }
}
