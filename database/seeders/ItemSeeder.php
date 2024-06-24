<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemPic;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $n_items = 30;
        $faker = FakerFactory::create();
        $categoryIdApiData = [
            1 => 'abcat0501000',
            2 => 'abcat0401000',
            3 => 'abcat0204000',
            4 => 'pcmcat209000050006',
            5 => 'abcat0502000',
            6 => 'pcmcat310200050004',
            7 => 'abcat0101000',
        ];

        for ($i = 0; $i < $n_items; $i++) {
            $categoryId = Category::inRandomOrder()->value('id');
            $categoryIdApi = $categoryIdApiData[$categoryId];

            $response = Http::get("https://api.bestbuy.com/v1/products((categoryPath.id={$categoryIdApi}))?sort=name.asc&show=name,longDescription,regularPrice,image&pageSize=30&format=json&apiKey=lruUnUawYKGJG01sMNPzMTRO");

            if ($response->successful() && isset($response['products']) && count($response['products']) > 0) {
                $product = $response['products'][rand(0, count($response['products']) - 1)];

                // Descargar la imagen y guardarla localmente
                $imageUrl = $product['image'];
                if (!empty($imageUrl)) {
                    $imageData = file_get_contents($imageUrl);
                    $imageName = uniqid('item_') . '.' . pathinfo($imageUrl, PATHINFO_EXTENSION);
                    Storage::disk('public')->put('photos/' . $imageName, $imageData);

                    $item = Item::create([
                        'category_id' => $categoryId,
                        'name' => $product['name'],
                        'description' => $product['longDescription'] ?? '',
                        'stock' => rand(0, 100),
                        'price' => $product['regularPrice'] ?? 0,
                        'owner' => ['Tienda', 'Cliente'][rand(0, 1)],
                    ]);

                    // Crear un nuevo ItemPic con el nombre del archivo
                    $itemPic = new ItemPic(['url' => $imageName]);
                    $item->itemPics()->save($itemPic);
                } else {
                    // Manejar el caso donde la URL de la imagen está vacía
                    continue; // O podrías agregar alguna lógica para manejarlo
                }
            } else {
                Item::create([
                    'category_id' => $categoryId,
                    'name' => $faker->word(),
                    'description' => $faker->sentence(),
                    'stock' => $faker->numberBetween(0, 100),
                    'price' => $faker->randomFloat(2, 80, 3000),
                    'owner' => $faker->randomElement(['Tienda', 'Cliente']),
                ]);
            }
        }
    }
}
