<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\zones.json');
        $zones = json_decode($jsonData, true);

        // Insertar cada registro en la tabla
        foreach ($zones['zones']['zona'] as $zone) {
            Zone::create([
                'name'     => $zone['Nom'],
            ]);
        }

    }
}
