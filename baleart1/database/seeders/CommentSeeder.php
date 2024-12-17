<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Space;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // Des d'un arxiu JSON
            $jsonData = file_get_contents('c:\\temp\\baleart\\comentaris.json');
            $comments = json_decode($jsonData, true);
    
            // Insertar cada registro en la tabla
            foreach ($comments['comentaris']['comentari'] as $comment) {
                Comment::create([
                    'user_id' => User::where('email', $comment['usuari'])->first()->id,
                    'space_id'     => Space::where('regNumber', $comment['espai'])->first()->id,
                    'comment'     => $comment['text'],
                    'score'     => $comment['puntuacio'],
                ]);
            }
        }
    }
}
