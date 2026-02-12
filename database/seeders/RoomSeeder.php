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
        
        // Floor 1 Rooms - Coordinates matching SVG label positions exactly
        $floor1Rooms = [
            // TOP ROW CLASSROOMS (y ~ 180)
            ['name' => 'Room 102 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 340, 'center_y' => 180, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 104 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 455, 'center_y' => 180, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 106 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 580, 'center_y' => 180, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 108 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 710, 'center_y' => 180, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 110 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 820, 'center_y' => 180, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => "Room 112 Registrar's Office", 'floor' => 1, 'type' => 'office', 'center_x' => 920, 'center_y' => 180, 'description' => "Registrar's Office", 'is_searchable' => true],
            
            // BOTTOM ROW LEFT SIDE (y ~ 400)
            ['name' => '1F Clinic', 'floor' => 1, 'type' => 'clinic', 'center_x' => 75, 'center_y' => 380, 'description' => 'First Floor Clinic', 'is_searchable' => true],
            ['name' => 'Room 101', 'floor' => 1, 'type' => 'classroom', 'center_x' => 210, 'center_y' => 400, 'description' => 'Room 101', 'is_searchable' => true],
            ['name' => 'Comfort Room', 'floor' => 1, 'type' => 'restroom', 'center_x' => 340, 'center_y' => 400, 'description' => 'Restroom', 'is_searchable' => true],
            
            // BOTTOM ROW CENTER
            ['name' => 'Room 103-B Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 510, 'center_y' => 350, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 103-A Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 455, 'center_y' => 420, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 105 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 580, 'center_y' => 420, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'EE Shop', 'floor' => 1, 'type' => 'shop', 'center_x' => 720, 'center_y' => 400, 'description' => 'EE Shop', 'is_searchable' => true],
            ['name' => 'Room 111 Cashier', 'floor' => 1, 'type' => 'office', 'center_x' => 880, 'center_y' => 400, 'description' => 'Cashier', 'is_searchable' => true],
            
            // RIGHT SIDE
            ['name' => 'Career Center', 'floor' => 1, 'type' => 'office', 'center_x' => 1250, 'center_y' => 340, 'description' => 'Career Center', 'is_searchable' => true],
            ['name' => 'Elevator', 'floor' => 1, 'type' => 'elevator', 'center_x' => 1140, 'center_y' => 365, 'description' => 'Elevator', 'is_searchable' => true],
            
            // AMT AREA (yellow section, y ~ 680)
            ['name' => 'AMT Laboratory', 'floor' => 1, 'type' => 'lab', 'center_x' => 880, 'center_y' => 680, 'description' => 'AMT Laboratory', 'is_searchable' => true],
            ['name' => 'Comfort Room AMT', 'floor' => 1, 'type' => 'restroom', 'center_x' => 700, 'center_y' => 780, 'description' => 'CR', 'is_searchable' => true],
            
            // HANGAR AREA (right side with planes, x ~ 1150)
            ['name' => 'Hangar', 'floor' => 1, 'type' => 'hangar', 'center_x' => 1150, 'center_y' => 700, 'description' => 'Hangar', 'is_searchable' => true],
            ['name' => 'CR', 'floor' => 1, 'type' => 'restroom', 'center_x' => 1050, 'center_y' => 530, 'description' => 'CR', 'is_searchable' => true],
            
            // STAIRS
            ['name' => 'Stairs Main', 'floor' => 1, 'type' => 'stairs', 'center_x' => 280, 'center_y' => 100, 'description' => 'Stairs', 'is_searchable' => true],
            ['name' => 'Stairs East', 'floor' => 1, 'type' => 'stairs', 'center_x' => 1000, 'center_y' => 410, 'description' => 'Stairs', 'is_searchable' => true],
            
            // EXITS
            ['name' => 'Exit Main', 'floor' => 1, 'type' => 'exit', 'center_x' => 195, 'center_y' => 115, 'description' => 'Exit', 'is_searchable' => true],
            ['name' => 'Exit East', 'floor' => 1, 'type' => 'exit', 'center_x' => 1055, 'center_y' => 115, 'description' => 'Exit', 'is_searchable' => true],
            ['name' => 'Exit Career', 'floor' => 1, 'type' => 'exit', 'center_x' => 1280, 'center_y' => 255, 'description' => 'Exit', 'is_searchable' => true],
            ['name' => 'Exit Hangar', 'floor' => 1, 'type' => 'exit', 'center_x' => 1280, 'center_y' => 660, 'description' => 'Exit', 'is_searchable' => true],
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
