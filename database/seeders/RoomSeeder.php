<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing rooms (use query builder for compatibility)
        Room::query()->delete();
        
        // Floor 1 Rooms - Based on actual SVG floor plan with accurate coordinates
        $floor1Rooms = [
            // Top Row - Classrooms (y ~ 140)
            ['name' => 'Room 102 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 420, 'center_y' => 140, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 104 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 530, 'center_y' => 140, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 106 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 640, 'center_y' => 140, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 108 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 750, 'center_y' => 140, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 110 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 860, 'center_y' => 140, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 112 Registrar\'s Office', 'floor' => 1, 'type' => 'office', 'center_x' => 970, 'center_y' => 140, 'description' => 'Registrar\'s Office', 'is_searchable' => true],
            
            // Middle Row Bottom (y ~ 380)
            ['name' => '1F Clinic', 'floor' => 1, 'type' => 'clinic', 'center_x' => 160, 'center_y' => 350, 'description' => 'First Floor Clinic', 'is_searchable' => true],
            ['name' => 'Room 101', 'floor' => 1, 'type' => 'classroom', 'center_x' => 270, 'center_y' => 390, 'description' => 'Room 101', 'is_searchable' => true],
            ['name' => 'Comfort Room', 'floor' => 1, 'type' => 'restroom', 'center_x' => 400, 'center_y' => 390, 'description' => 'Restroom', 'is_searchable' => true],
            ['name' => 'Room 103-A Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 520, 'center_y' => 390, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 103-B Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 590, 'center_y' => 330, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 105 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 660, 'center_y' => 390, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'EE Shop', 'floor' => 1, 'type' => 'shop', 'center_x' => 790, 'center_y' => 380, 'description' => 'Electrical Engineering Shop', 'is_searchable' => true],
            ['name' => 'Room 111 Cashier', 'floor' => 1, 'type' => 'office', 'center_x' => 920, 'center_y' => 380, 'description' => 'Cashier Office', 'is_searchable' => true],
            ['name' => 'Career Center', 'floor' => 1, 'type' => 'office', 'center_x' => 1150, 'center_y' => 380, 'description' => 'Career Center Office', 'is_searchable' => true],
            
            // Bottom Section - AMT Area
            ['name' => 'AMT Laboratory', 'floor' => 1, 'type' => 'lab', 'center_x' => 920, 'center_y' => 700, 'description' => 'Aviation Maintenance Technology Laboratory', 'is_searchable' => true],
            ['name' => 'Comfort Room AMT', 'floor' => 1, 'type' => 'restroom', 'center_x' => 780, 'center_y' => 770, 'description' => 'AMT Area Restroom', 'is_searchable' => true],
            ['name' => 'Hangar', 'floor' => 1, 'type' => 'hangar', 'center_x' => 1200, 'center_y' => 700, 'description' => 'Aircraft Hangar', 'is_searchable' => true],
            
            // Exits
            ['name' => 'Exit Main', 'floor' => 1, 'type' => 'exit', 'center_x' => 295, 'center_y' => 105, 'description' => 'Main Building Exit', 'is_searchable' => true],
            ['name' => 'Exit East', 'floor' => 1, 'type' => 'exit', 'center_x' => 1095, 'center_y' => 105, 'description' => 'East Side Exit', 'is_searchable' => true],
            ['name' => 'Exit Career Center', 'floor' => 1, 'type' => 'exit', 'center_x' => 1280, 'center_y' => 240, 'description' => 'Career Center Exit', 'is_searchable' => true],
            ['name' => 'Exit Hangar', 'floor' => 1, 'type' => 'exit', 'center_x' => 1300, 'center_y' => 535, 'description' => 'Hangar Area Exit', 'is_searchable' => true],
            
            // Stairs and Elevator
            ['name' => 'Stairs', 'floor' => 1, 'type' => 'stairs', 'center_x' => 350, 'center_y' => 190, 'description' => 'Main Stairway', 'is_searchable' => true],
            ['name' => 'Elevator', 'floor' => 1, 'type' => 'elevator', 'center_x' => 1175, 'center_y' => 345, 'description' => 'Building Elevator', 'is_searchable' => true],
        ];
        
        foreach ($floor1Rooms as $room) {
            Room::create($room);
        }
        
        // Add placeholder rooms for floors 2-8 (to be detailed later with actual floor plan data)
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
