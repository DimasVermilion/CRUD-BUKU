<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'author' => fake()->name(),
            'page' => fake()->numberBetween(75,300),
            'publish_date' => fake()->date(),
            'category_id' => fake()->numberBetween(1,5),
        ];
    }
}
