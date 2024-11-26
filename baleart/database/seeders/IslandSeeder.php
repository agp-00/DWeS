<?php

namespace Database\Seeders;

use App\Models\Island;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IslandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $illes = ['Mallorca', 'Eivissa', 'Menorca', 'Formentera'];

        // Insertar cada registro en la tabla
        foreach ($illes as $illa) {
            Island::create([
                'name'     => $illa,
            ]);
        }

    }

}
