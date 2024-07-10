<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Takeaway Menu'],
            ['name' => 'Large Format'],
            ['name' => 'Leaflets'],
            ['name' => 'Dine In Menus'],
            ['name' => 'Booklets'],
            ['name' => 'Business Cards'],
            ['name' => 'Digital Jobs'],
            ['name' => 'Order Pads'],
            ['name' => 'Other'],
            ['name' => 'Printed Clothing'],
            ['name' => 'Design'],
            ['name' => 'Plain Pads'],
            ['name' => 'NCR Pads'],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
