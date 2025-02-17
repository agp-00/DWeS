<?php

namespace Database\Seeders;

use App\Models\Space;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\spaces.json');
        $images = json_decode($jsonData, true);

        foreach ($images as $imageData) {
            $space = Space::where('regNumber', $imageData['registre'])->first();

            if ($space) {
                Image::create([
                    'id' => $space->id,
                    'url' => $imageData['image'],
                ]);
            }
        }
    }
}
