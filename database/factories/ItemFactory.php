<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::pluck('id')->toArray();
        return [
            'category_id'=>fake()->randomElement($category),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'stock' => fake()->numberBetween(0, 100),
            'price' => fake()->randomFloat(2, 80, 3000),
            'owner' => fake()->randomElement(['Tienda', 'Cliente']),
        ];
    }
}
