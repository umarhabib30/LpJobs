<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['size' => 'A0 (841 x 1188 mm)'],
            ['size' => 'A1 (841 x 594 mm)'],
            ['size' => 'A2 (594 x 420 mm)'],
            ['size' => 'A3 (420 x 297 mm)'],
            ['size' => 'A4 (297 x 210 mm)'],
            ['size' => 'A5 (210 x 148 mm)'],
            ['size' => 'A6 (148 x 105 mm)'],
            ['size' => 'A7 (105 x 74 mm)'],
            ['size' => 'Custom Size (See notes for detail)'],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
