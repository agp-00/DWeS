<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(IslandSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(SpaceTypeSeeder::class);
        $this->call(ModalitySeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TranslationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SpaceSeeder::class);
        $this->call(CommentSeeder::class);

        // User::factory(10)->create();

       /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
