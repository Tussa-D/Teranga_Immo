<?php

namespace Database\Factories;

use App\Models\Bien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annonce>
 */
class AnnonceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_publication' => $this->faker->date,
            'image' => fake()->image(),
            'description' => fake()->text(),
            'video' => fake()->image(),
            'bien_id' => Bien::factory(),
        ];
    }
}
