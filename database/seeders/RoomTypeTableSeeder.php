<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            ['name' => 'Standard', 'price_per_night' => 100, 'max_occupancy' => 4, 'description' => 'test'],
            ['name' => 'Superior', 'price_per_night' => 200, 'max_occupancy' => 4, 'description' => 'test'],
            ['name' => 'Deluxe', 'price_per_night' => 300, 'max_occupancy' => 4, 'description' => 'test'],
        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
