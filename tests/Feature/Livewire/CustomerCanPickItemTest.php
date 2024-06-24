<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Item\ShowModal;
use App\Models\Item;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerCanPickItemTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function renders_successfully()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();

        $this->seed(CategorySeeder::class);
        $item=Item::factory()->create([
        'category_id' => 1,
        'name' => 'testing name',
        'description' => 'testing description',
        'stock' => 1,
        'price' => 10.0,
        'owner' => 'Tienda',
        ]);
        Livewire::actingAs($user)->test(ShowModal::class, ['item' => $item])
            ->assertStatus(200);
    }
    /** @test */
    public function customer_can_add_item_store_to_cart()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();

        $this->seed(CategorySeeder::class);
        $item=Item::factory()->create([
        'category_id' => 1,
        'name' => 'testing name',
        'description' => 'testing description',
        'stock' => 1,
        'price' => 10.0,
        'owner' => 'Tienda',
        ]);
        Livewire::actingAs($user)->test(ShowModal::class, ['item' => $item])
            ->call('addCart', $item)
            ->assertHasNoErrors();
        $this->assertSoftDeleted($item);
        $this->assertDatabaseCount('shopping_cart_details', 1);
    }
}
