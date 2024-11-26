<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // Des d'un arxiu JSON
            $jsonData = file_get_contents('c:\\temp\\baleart\\traduccions.json');
            $translations = json_decode($jsonData, true);
    
            // Insertar cada registro en la tabla
            foreach ($translations['traduccions']['terme'] as $translation) {
                Translation::create([
                    'description_CA'     => $translation['cat'],
                    'description_ES'     => $translation['esp'],
                    'description_EN'     => $translation['eng'],
                ]);
            }
    
        }
    }
}
