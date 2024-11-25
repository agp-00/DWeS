<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\usuaris.json');
        $usuaris = json_decode($jsonData, true);

        // Insertar cada registro en la tabla
        foreach ($usuaris['usuaris']['usuari'] as $usuari) {
            User::create([
                'Name'     => $usuari['nom'],
                'lastName' => $usuari['llinatges'],
                'email' => $usuari['email'],
                'phone' => $usuari['telefon'],
                'password' => $usuari['password'],
                'role_id' => Role::where('name', "gestor")->first()->id,
            ]);
        }

        //administrador

        //factory visitantes

    }
}
