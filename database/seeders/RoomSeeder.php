<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing rooms
        Room::truncate();
        
        // Floor 1 Rooms - Based on actual SVG floor plan image
        $floor1Rooms = [
            // Top Row - Classrooms (y ~ 130)
            ['name' => 'Room 102 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 540, 'center_y' => 130, 'description' => 'Classroom'],
            ['name' => 'Room 104 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 650, 'center_y' => 130, 'description' => 'Classroom'],
            ['name' => 'Room 106 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 760, 'center_y' => 130, 'description' => 'Classroom'],
            ['name' => 'Room 108 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 870, 'center_y' => 130, 'description' => 'Classroom'],
            ['name' => 'Room 110 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 980, 'center_y' => 130, 'description' => 'Classroom'],
            ['name' => 'Room 112 Registrar\'s Office', 'floor' => 1, 'type' => 'office', 'center_x' => 1100, 'center_y' => 130, 'description' => 'Registrar\'s Office'],
            
            // Middle Row (y ~ 380)
            ['name' => '1F Clinic', 'floor' => 1, 'type' => 'clinic', 'center_x' => 330, 'center_y' => 320, 'description' => 'First Floor Clinic'],
            ['name' => 'Room 101', 'floor' => 1, 'type' => 'classroom', 'center_x' => 420, 'center_y' => 380, 'description' => 'Room 101'],
            ['name' => 'Comfort Room 1F', 'floor' => 1, 'type' => 'restroom', 'center_x' => 520, 'center_y' => 380, 'description' => 'First Floor Restroom'],
            ['name' => 'Room 103-A Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 620, 'center_y' => 380, 'description' => 'Classroom'],
            ['name' => 'Room 103-B Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 700, 'center_y' => 340, 'description' => 'Classroom'],
            ['name' => 'Room 105 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 780, 'center_y' => 380, 'description' => 'Classroom'],
            ['name' => 'EE Shop', 'floor' => 1, 'type' => 'shop', 'center_x' => 900, 'center_y' => 380, 'description' => 'Electrical Engineering Shop'],
            ['name' => 'Room 111 Cashier', 'floor' => 1, 'type' => 'office', 'center_x' => 1020, 'center_y' => 380, 'description' => 'Cashier Office'],
            ['name' => 'Career Center', 'floor' => 1, 'type' => 'office', 'center_x' => 1300, 'center_y' => 340, 'description' => 'Career Center Office'],
            
            // Bottom Section
            ['name' => 'AMT Laboratory', 'floor' => 1, 'type' => 'lab', 'center_x' => 1000, 'center_y' => 700, 'description' => 'Aviation Maintenance Technology Laboratory'],
            ['name' => 'Comfort Room AMT', 'floor' => 1, 'type' => 'restroom', 'center_x' => 865, 'center_y' => 790, 'description' => 'AMT Area Restroom'],
            ['name' => 'Hangar', 'floor' => 1, 'type' => 'hangar', 'center_x' => 1650, 'center_y' => 700, 'description' => 'Aircraft Hangar'],
            
            // Exits
            ['name' => 'Exit (Main)', 'floor' => 1, 'type' => 'exit', 'center_x' => 400, 'center_y' => 95, 'description' => 'Main Building Exit'],
            ['name' => 'Exit (East)', 'floor' => 1, 'type' => 'exit', 'center_x' => 1150, 'center_y' => 95, 'description' => 'East Side Exit'],
            ['name' => 'Exit (Career Center)', 'floor' => 1, 'type' => 'exit', 'center_x' => 1350, 'center_y' => 230, 'description' => 'Career Center Exit'],
            ['name' => 'Exit (Hangar)', 'floor' => 1, 'type' => 'exit', 'center_x' => 1350, 'center_y' => 530, 'description' => 'Hangar Area Exit'],
            
            // Stairs and Elevator
            ['name' => 'Stairs 1F', 'floor' => 1, 'type' => 'stairs', 'center_x' => 370, 'center_y' => 200, 'description' => 'Main Stairway'],
            ['name' => 'Elevator', 'floor' => 1, 'type' => 'elevator', 'center_x' => 1220, 'center_y' => 340, 'description' => 'Building Elevator'],
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
