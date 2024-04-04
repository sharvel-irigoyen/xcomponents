<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerItem>
 */
class CustomerItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersId = User::where('role_id','2')->pluck('id')->toArray();
        $itemsId = Item::where('owner','Cliente')->pluck('id')->toArray();

        $user=fake()->randomElement($usersId);
        $item=fake()->randomElement($itemsId);

        Item::find($item)->delete();
        return [
            'user_id'=>$user,
            'item_id'=>$item,
        ];
    }
}
