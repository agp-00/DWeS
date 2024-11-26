<?php

namespace Database\Seeders;

use App\Models\SpaceType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // Des d'un arxiu JSON
            $jsonData = file_get_contents('c:\\temp\\baleart\\tipus.json');
            $types = json_decode($jsonData, true);
    
            // Insertar cada registro en la tabla
            foreach ($types['tipusespais']['tipus'] as $type) {
                SpaceType::create([
                    'name'     => $type['cat'],
                    'description_CA'     => $type['cat'],
                    'description_ES'     => $type['esp'],
                    'description_EN'     => $type['eng'],
                ]);
            }
    
        }
    }
}
