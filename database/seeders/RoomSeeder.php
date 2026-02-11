<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Floor 1 Rooms - Based on SVG text labels
        $floor1Rooms = [
            ['name' => 'EXIT', 'floor' => 1, 'type' => 'exit', 'center_x' => 141.5, 'center_y' => 95, 'description' => 'Main Exit'],
            ['name' => 'EXIT', 'floor' => 1, 'type' => 'exit', 'center_x' => 1433, 'center_y' => 91, 'description' => 'Side Exit'],
            ['name' => 'EXIT', 'floor' => 1, 'type' => 'exit', 'center_x' => 1730, 'center_y' => 226, 'description' => 'Emergency Exit'],
            
            // Classrooms and Labs (estimated coordinates from SVG structure)
            ['name' => 'Computer Lab 1', 'floor' => 1, 'type' => 'lab', 'center_x' => 390, 'center_y' => 410, 'description' => 'Computer Laboratory'],
            ['name' => 'Computer Lab 2', 'floor' => 1, 'type' => 'lab', 'center_x' => 621, 'center_y' => 380, 'description' => 'Computer Laboratory'],
            ['name' => 'Classroom 101', 'floor' => 1, 'type' => 'classroom', 'center_x' => 621, 'center_y' => 130, 'description' => 'Regular Classroom'],
            ['name' => 'Classroom 102', 'floor' => 1, 'type' => 'classroom', 'center_x' => 831, 'center_y' => 130, 'description' => 'Regular Classroom'],
            ['name' => 'Classroom 103', 'floor' => 1, 'type' => 'classroom', 'center_x' => 975, 'center_y' => 130, 'description' => 'Regular Classroom'],
            ['name' => 'Classroom 104', 'floor' => 1, 'type' => 'classroom', 'center_x' => 1148, 'center_y' => 130, 'description' => 'Regular Classroom'],
            ['name' => 'Classroom 105', 'floor' => 1, 'type' => 'classroom', 'center_x' => 621, 'center_y' => 380, 'description' => 'Regular Classroom'],
            ['name' => 'Classroom 106', 'floor' => 1, 'type' => 'classroom', 'center_x' => 831, 'center_y' => 380, 'description' => 'Regular Classroom'],
            ['name' => 'Classroom 107', 'floor' => 1, 'type' => 'classroom', 'center_x' => 1025, 'center_y' => 380, 'description' => 'Regular Classroom'],
            ['name' => 'Classroom 108', 'floor' => 1, 'type' => 'classroom', 'center_x' => 1148, 'center_y' => 380, 'description' => 'Regular Classroom'],
            
            // Facilities
            ['name' => 'Restroom 1', 'floor' => 1, 'type' => 'restroom', 'center_x' => 1275, 'center_y' => 380, 'description' => 'Restroom'],
            ['name' => 'Stairs 1', 'floor' => 1, 'type' => 'stairs', 'center_x' => 47, 'center_y' => 130, 'description' => 'Stairway'],
            ['name' => 'Elevator', 'floor' => 1, 'type' => 'elevator', 'center_x' => 1215, 'center_y' => 480, 'description' => 'Elevator'],
            
            // Offices
            ['name' => 'Admin Office', 'floor' => 1, 'type' => 'office', 'center_x' => 191, 'center_y' => 410, 'description' => 'Administrative Office'],
            ['name' => 'Faculty Room', 'floor' => 1, 'type' => 'office', 'center_x' => 47, 'center_y' => 320, 'description' => 'Faculty Office'],
            ['name' => 'Storage', 'floor' => 1, 'type' => 'storage', 'center_x' => 1470, 'center_y' => 380, 'description' => 'Storage Room'],
            ['name' => 'Reception', 'floor' => 1, 'type' => 'office', 'center_x' => 1505, 'center_y' => 410, 'description' => 'Reception Area'],
        ];
        
        foreach ($floor1Rooms as $room) {
            Room::create($room);
        }
        
        // Add placeholder rooms for floors 2-8 (to be detailed later)
        for ($floor = 2; $floor <= 8; $floor++) {
            Room::create([
                'name' => "Floor {$floor} Main Area",
                'floor' => $floor,
                'type' => 'area',
                'center_x' => 900,
                'center_y' => 400,
                'description' => "Main area of floor {$floor}",
                'is_searchable' => true
            ]);
        }
    }
}
