<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\CustomerItem;
use App\Models\Item;
use App\Models\ItemPic;
use App\Models\Role;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Faker\Factory as FakerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        if (Role::count() === 0) {
            $this->call(RoleSeeder::class);
        }

        if (User::count() === 0) {
            User::factory(10)->create();
        }
        $existingUser = User::where('name', 'Test User')->first();
        if (!$existingUser) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('xcomponents#123'),
                'role_id'=>1
            ]);
        }

        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }

        if (Item::count() === 0) {
            $this->call(ItemSeeder::class);
        }

        // if (ItemPic::count() === 0) {
        //     ItemPic::factory(5)->create();
        //     // ItemPic::factory(600)->create();
        // }
        // if (CustomerItem::count() === 0) {
        //     CustomerItem::factory(40)->create();
        // }
        // if (ShoppingCartDetail::count() === 0) {
        //     ShoppingCartDetail::factory(40)->create();
        // }

        //actualizacion de los precios en ShoppingCart descontando si el producto pertenece al cliente
        // $shoppingCarts = ShoppingCart::with('shoppingCartDetails.item')->get();

        // foreach ($shoppingCarts as $shoppingCart) {
        //     $totalStorePrice = $shoppingCart->shoppingCartDetails->where('item.owner', 'Tienda')->sum('item.price');
        //     $totalCustomerPrice = $shoppingCart->shoppingCartDetails->where('item.owner', 'Cliente')->sum('item.price');

        //     $totalPrice = $totalStorePrice - $totalCustomerPrice;
        //     $shoppingCart->update([
        //         'total_price' => $totalPrice
        //     ]);
        // }
    }
}
