<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ItemPic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemPic>
 */
class ItemPicFactory extends Factory
{
    protected $model = ItemPic::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $item = Item::pluck('id')->toArray();
        $itemDirectory = storage_path('app/public/items');
        if (!is_dir($itemDirectory)) {
            mkdir($itemDirectory, 0777, true);
        }
        $itemPath = $this->faker->image($itemDirectory, 600, 600);
        return [
            'item_id' => fake()->randomElement($item),
            'url' => $this->faker->imageUrl(600,600),
            // 'url' => basename($itemPath),
        ];
    }
}
