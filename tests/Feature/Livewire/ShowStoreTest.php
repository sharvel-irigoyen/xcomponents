<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Item\Index;
use App\Models\Item;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ItemSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowStoreTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Index::class)
            ->assertStatus(200);
    }
    /** @test */
    public function displays_store()
    {
        $this->seed(CategorySeeder::class);
        Item::factory()->create([
        'category_id' => 1,
        'name' => 'testing name',
        'description' => 'testing description',
        'stock' => 1,
        'price' => 10.0,
        'owner' => 'Tienda',
    ]);

        Livewire::test(Index::class)
            ->assertSee('Desktop & All-in-One Computers')
            ->assertSee('testing name')
            ->assertSee('testing description')
            ->assertSee('Stock: 1')
            ->assertSee('USD 10.0');
    }
}
