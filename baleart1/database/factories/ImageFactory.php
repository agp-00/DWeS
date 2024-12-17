<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\SpaceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$spaces = json_decode(file_get_contents('c:\\temp\\baleart\\espais.json'), true);
        //$space = $spaces[array_rand($spaces)];
            
        return [

            'url' => fake()->imageUrl(),
            //'comment_id' => SpaceType::where('name', $space['tipus'])->first()->id,
            'comment_id' => Comment::inRandomOrder()->first()->id,
        ];
        
    }
}
