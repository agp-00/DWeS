<?php

namespace Database\Seeders;

use App\Models\Island;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\municipis.json');
        $municipilaties = json_decode($jsonData, true);

        // Insertar cada registro en la tabla
        foreach ($municipilaties['municipis']['municipi'] as $municipality) {
            Municipality::create([
                'name'     => $municipality['Nom'],
                'island_id' => Island::where('name', $municipality['Illa'])->first()->id,
            ]);
        }

    }

}