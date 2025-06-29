<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Room ' . fake()->unique()->randomNumber(3),
            'capacity' => fake()->numberBetween(1, 4),
            'price_per_night' => fake()->numberBetween(900, 5000)
        ];
    }
}
