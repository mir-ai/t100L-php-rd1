<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
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
            'record_id' => fake()->word(),
            'pref_name' => substr(fake()->word(), 0, 8),
            'city_name' => fake()->word(),
            'event_name' => fake()->word(),
            'event_kana' => fake()->word(),
            'event_en' => fake()->word(),
            'start_date' => fake()->dateTimeBetween("-1 month", "-1 minutes")->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween("-1 month", "-1 minutes")->format('Y-m-d'),
            'start_time' => sprintf("%02d:%02d", fake()->randomNumber(2), fake()->randomNumber(2)),
            'end_time' => sprintf("%02d:%02d", fake()->randomNumber(2), fake()->randomNumber(2)),
            'start_memo' => fake()->text(),
            'description' => fake()->text(),
            'fee_basic' => fake()->word(),
            'fee_detail' => fake()->text(),
            'contact_name' => fake()->text(),
            'contact_tel' => fake()->word(),
            'contact_tel_ext' => fake()->text(20),
            'organizer' => fake()->word(),
            'location_name' => fake()->word(),
            'address' => fake()->word(),
            'address2' => fake()->word(),
            'lat' => fake()->text(12),
            'lng' => fake()->text(12),
            'access' => fake()->text(),
            'parking' => fake()->word(),
            'capacity' => fake()->word(),
            'entry_due_date' => fake()->text(10),
            'entry_due_time' => fake()->word(),
            'entry_method' => fake()->text(),
            'entry_url' => fake()->text(),
            'memo' => fake()->text(),
            'category' => fake()->text(12),
            'ward_name' => fake()->text(12),
            'open_date' => fake()->dateTimeBetween("-1 month", "-1 minutes")->format('Y-m-d'),
            'update_date' => fake()->dateTimeBetween("-1 month", "-1 minutes")->format('Y-m-d'),
            'is_childcare' => substr(fake()->word(), 0, 1),
            'location_no' => fake()->word(),
        ];
    }
}
