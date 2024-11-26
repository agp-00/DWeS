<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\rols.json');
        $roles = json_decode($jsonData, true);

        // Insertar cada registro en la tabla
        foreach ($roles['roles']['role'] as $role) {
            Role::create([
                'name'     => $role['Nom'],
            ]);
        }

    }
}
