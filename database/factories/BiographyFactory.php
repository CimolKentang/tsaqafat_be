<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biography>
 */
class BiographyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'birth' => fake()->year(),
            'death' => fake()->year(),
            'description' => fake()->paragraph(5),
            'works' => fake()->text(),
            'field_id' => mt_rand(1, 5)
        ];
    }
}
