<?php

namespace Database\Factories;

use App\Models\CustomerItem;
use App\Models\Item;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoppingCartDetailFactory extends Factory
{
    public function definition(): array
    {
        $userIds = User::where('role_id', '2')->pluck('id')->toArray();
        $userId = $this->faker->randomElement($userIds);

        // Obtener los IDs de los items relacionados con el usuario
        $itemCustomerIds = CustomerItem::where('user_id', $userId)->pluck('item_id')->toArray();
        $itemStoreIds = Item::where('owner', 'Tienda')->inRandomOrder()->take(3)->pluck('id')->toArray();
        $itemIds = array_merge($itemCustomerIds, $itemStoreIds);
        $itemId = $this->faker->randomElement($itemIds);

        // Verificar si existe un shopping cart para el usuario
        $shoppingCart = ShoppingCart::where('user_id', $userId)->first();
        if (!$shoppingCart) {
            $shoppingCart = ShoppingCart::create([
                'user_id' => $userId,
            ]);
        }

        // Obtener el ID del shopping cart
        $shoppingCartId = $shoppingCart->id;

        // Verificar si el item existe y eliminarlo
        if (Item::where('id', $itemId)->exists()) {
            Item::find($itemId)->delete();
        }
        // Verificar si el item existe en customerItems eliminarlo
        if (CustomerItem::where('item_id', $itemId)->exists()) {
            CustomerItem::where('item_id', $itemId)->delete();
        }

        return [
            'item_id' => $itemId,
            'shopping_cart_id' => $shoppingCartId,
        ];
    }
}
