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
        
        // Floor 1 Rooms - Based on actual SVG coordinates (viewBox: 0 0 1821 870)
        // Analyzed from SVG path data for accurate positioning
        $floor1Rooms = [
            // TOP ROW - Classrooms (from SVG: y=52 to y=210, center_y ~ 131)
            // Room boundaries from SVG: 314.5, 448.5, 601, 755, 907.5, 1061
            ['name' => 'Room 102 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 381, 'center_y' => 131, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 104 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 525, 'center_y' => 131, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 106 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 678, 'center_y' => 131, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 108 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 831, 'center_y' => 131, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 110 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 984, 'center_y' => 131, 'description' => 'Classroom', 'is_searchable' => true],
            // Room 112 is separate: x=1082.5 to 1214.5
            ['name' => "Room 112 Registrar's Office", 'floor' => 1, 'type' => 'office', 'center_x' => 1148, 'center_y' => 131, 'description' => "Registrar's Office", 'is_searchable' => true],
            
            // BOTTOM ROW - Left side (from SVG: y=359 to y=460, center_y ~ 410)
            // 1F Clinic: path M7.5 260.361...V461 (orange area, x=7-87)
            ['name' => '1F Clinic', 'floor' => 1, 'type' => 'clinic', 'center_x' => 47, 'center_y' => 360, 'description' => 'First Floor Clinic', 'is_searchable' => true],
            // Room 101: path M295.5 359V460H87.5 (gray area, x=87-295)
            ['name' => 'Room 101', 'floor' => 1, 'type' => 'classroom', 'center_x' => 191, 'center_y' => 410, 'description' => 'Room 101', 'is_searchable' => true],
            // Comfort Room: rect x=314.5 y=360 width=152 height=99 (green area)
            ['name' => 'Comfort Room', 'floor' => 1, 'type' => 'restroom', 'center_x' => 390, 'center_y' => 410, 'description' => 'Restroom', 'is_searchable' => true],
            
            // BOTTOM ROW - Center (from SVG: path M468.5 301V459H774.5)
            ['name' => 'Room 103-A Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 430, 'center_y' => 410, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 103-B Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 500, 'center_y' => 355, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'Room 105 Classroom', 'floor' => 1, 'type' => 'classroom', 'center_x' => 565, 'center_y' => 410, 'description' => 'Classroom', 'is_searchable' => true],
            ['name' => 'EE Shop', 'floor' => 1, 'type' => 'shop', 'center_x' => 720, 'center_y' => 385, 'description' => 'Electrical Engineering Shop', 'is_searchable' => true],
            
            // BOTTOM ROW - Right (from SVG: path M1080.5 301V459H774.5)
            ['name' => 'Room 111 Cashier', 'floor' => 1, 'type' => 'office', 'center_x' => 875, 'center_y' => 385, 'description' => 'Cashier Office', 'is_searchable' => true],
            
            // RIGHT SIDE - Career Center area (from SVG: path starting at 1506.5)
            ['name' => 'Career Center', 'floor' => 1, 'type' => 'office', 'center_x' => 1250, 'center_y' => 355, 'description' => 'Career Center Office', 'is_searchable' => true],
            
            // BOTTOM SECTION - AMT Area (yellow area from SVG: y=590 to y=858)
            ['name' => 'AMT Laboratory', 'floor' => 1, 'type' => 'lab', 'center_x' => 870, 'center_y' => 720, 'description' => 'Aviation Maintenance Technology Laboratory', 'is_searchable' => true],
            // AMT Comfort Room: path at bottom of AMT area
            ['name' => 'Comfort Room AMT', 'floor' => 1, 'type' => 'restroom', 'center_x' => 700, 'center_y' => 820, 'description' => 'AMT Area Restroom', 'is_searchable' => true],
            
            // HANGAR Area (from SVG: path starting x=1507.5, gray/light area with planes)
            ['name' => 'Hangar', 'floor' => 1, 'type' => 'hangar', 'center_x' => 1150, 'center_y' => 610, 'description' => 'Aircraft Hangar', 'is_searchable' => true],
            
            // CR (small restroom near stairs, right side)
            ['name' => 'CR', 'floor' => 1, 'type' => 'restroom', 'center_x' => 1030, 'center_y' => 530, 'description' => 'Restroom near stairs', 'is_searchable' => true],
            
            // Exits (green boxes in SVG)
            ['name' => 'Exit Main', 'floor' => 1, 'type' => 'exit', 'center_x' => 220, 'center_y' => 110, 'description' => 'Main Building Exit', 'is_searchable' => true],
            ['name' => 'Exit East', 'floor' => 1, 'type' => 'exit', 'center_x' => 1055, 'center_y' => 110, 'description' => 'East Side Exit', 'is_searchable' => true],
            ['name' => 'Exit Career Center', 'floor' => 1, 'type' => 'exit', 'center_x' => 1280, 'center_y' => 255, 'description' => 'Career Center Exit', 'is_searchable' => true],
            ['name' => 'Exit Hangar', 'floor' => 1, 'type' => 'exit', 'center_x' => 1280, 'center_y' => 610, 'description' => 'Hangar Area Exit', 'is_searchable' => true],
            
            // Stairs (multiple locations)
            ['name' => 'Stairs Main', 'floor' => 1, 'type' => 'stairs', 'center_x' => 280, 'center_y' => 100, 'description' => 'Main Stairway', 'is_searchable' => true],
            ['name' => 'Stairs East', 'floor' => 1, 'type' => 'stairs', 'center_x' => 1000, 'center_y' => 420, 'description' => 'East Stairway', 'is_searchable' => true],
            
            // Elevator
            ['name' => 'Elevator', 'floor' => 1, 'type' => 'elevator', 'center_x' => 1135, 'center_y' => 365, 'description' => 'Building Elevator', 'is_searchable' => true],
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
