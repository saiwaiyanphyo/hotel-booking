<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            ['room_number' => '101', 'room_type_id' => 1, 'status' => 'available'],
            ['room_number' => '102', 'room_type_id' => 1, 'status' => 'available'],
            ['room_number' => '103', 'room_type_id' => 1, 'status' => 'available'],
            ['room_number' => '104', 'room_type_id' => 1, 'status' => 'available'],
            ['room_number' => '201', 'room_type_id' => 2, 'status' => 'available'],
            ['room_number' => '202', 'room_type_id' => 2, 'status' => 'available'],
            ['room_number' => '203', 'room_type_id' => 2, 'status' => 'available'],
            ['room_number' => '204', 'room_type_id' => 2, 'status' => 'available'],
            ['room_number' => '301', 'room_type_id' => 3, 'status' => 'available'],
            ['room_number' => '302', 'room_type_id' => 3, 'status' => 'available'],
            ['room_number' => '303', 'room_type_id' => 3, 'status' => 'available'],
            ['room_number' => '304', 'room_type_id' => 3, 'status' => 'available'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
