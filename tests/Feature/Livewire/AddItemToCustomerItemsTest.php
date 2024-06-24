<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CustomerItem\AddModal;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AddItemToCustomerItemsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully():void
    {
        Livewire::test(AddModal::class)
            ->assertStatus(200);
    }
    /** @test */
    public function add_item_to_customer():void
    {
        Storage::fake('public');

        $image1 = UploadedFile::fake()->create('image1.jpg', 100);
        $image2 = UploadedFile::fake()->create('image2.jpg', 100);
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        Livewire::actingAs($user)->test(AddModal::class)
            ->set('categoryId', Category::factory()->create()->id)
            ->set('name', 'Nuevo Producto')
            ->set('description', 'Descripción del nuevo producto')
            ->set('stock', 10)
            ->set('price', 10.0)
            ->set('photos', [$image1, $image2])
            ->call('add')
            ->assertHasNoErrors();

            $this->assertTrue(Storage::disk('public')->exists('photos/' . $image1->hashName()));
            $this->assertTrue(Storage::disk('public')->exists('photos/' . $image2->hashName()));
    }
}
