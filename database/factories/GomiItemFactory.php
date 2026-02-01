<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GomiItem>
 */
class GomiItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kana1' => substr(fake()->word(), 0, 1),
            'name' => fake()->word(),
            'detail' => fake()->word(),
            'size' => fake()->word(),
            'gomi_type' => fake()->word(),
            'fee' => fake()->randomNumber(3),
            'description' => fake()->text(),
            'howto' => fake()->text(),
            'words' => fake()->text(),
            'url' => fake()->text(),
            'memo' => fake()->text(),
        ];
    }
}
