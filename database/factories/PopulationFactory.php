<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Population>
 */
class PopulationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pref_code' => fake()->randomNumber(4),
            'pref_name' => fake()->word(),
            'city_name' => fake()->word(),
            'yyyymm' => '20260201',
            'ward_code' => fake()->randomNumber(4),
            'ward_name' => fake()->word(),
            'district_name' => fake()->word(),
            'oaza_code' => fake()->randomNumber(4),
            'oaza_name' => fake()->word(),
            'age' => fake()->randomNumber(4),
            'total_count' => fake()->randomNumber(4),
            'male_count' => fake()->randomNumber(4),
            'female_count' => fake()->randomNumber(4),
            'description' => fake()->text(),
            'created_at' => fake()->dateTimeBetween("-1 month", "-1 minutes"),
            'updated_at' => fake()->dateTimeBetween("-1 month", "-1 minutes"),
        ];
    }
}
