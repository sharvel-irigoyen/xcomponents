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
        $categoryIdApiData = [
            1 => 'abcat0501000',
            2 => 'abcat0401000',
            3 => 'abcat0204000',
            4 => 'pcmcat209000050006',
            5 => 'abcat0502000',
            6 => 'pcmcat310200050004',
            7 => 'abcat0101000',
            // Agrega más mapeos según sea necesario para todas tus categorías locales
        ];


        $categoryIds = Category::pluck('id')->toArray();
        $categoryId = $this->faker->randomElement($categoryIds);
        $categoryIdApi = $categoryIdApiData[$categoryId];

        $response = Http::get("https://api.bestbuy.com/v1/products((categoryPath.id={$categoryIdApi}))?sort=name.asc&show=name,longDescription,regularPrice,image&pageSize=30&format=json&apiKey=lruUnUawYKGJG01sMNPzMTRO");

        if ($response->successful() && isset($response['products']) && count($response['products']) > 0) {
            $product = $response['products'][$this->faker->numberBetween(0, 29)];
            $itemData = [
                'category_id' => $categoryId,
                'name' => $product['name'],
                'description' => $product['longDescription'] ?? '',
                'stock' => $this->faker->numberBetween(0, 100),
                'price' => $product['regularPrice'] ?? 0,
                'owner' => $this->faker->randomElement(['Tienda', 'Cliente']),
            ];

            // Guardar el item en la base de datos
            $item = Item::create($itemData);

            // Crear el ItemPic y asociarlo con el item
            $itemPic = new ItemPic(['url' => $product['image']]);
            $item->itemPics()->save($itemPic);
        } else {
            // Si la solicitud no fue exitosa o no se recibieron productos, definir un estado predeterminado
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
}
