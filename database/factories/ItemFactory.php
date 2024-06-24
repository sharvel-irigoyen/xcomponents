<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemPic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryIds = Category::pluck('id')->toArray();
        $categoryId = $this->faker->randomElement($categoryIds);

        return [
            'category_id' => $categoryId,
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'stock' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomFloat(2, 80, 3000),
            'owner' => $this->faker->randomElement(['Tienda', 'Cliente']),
        ];
    }
}
