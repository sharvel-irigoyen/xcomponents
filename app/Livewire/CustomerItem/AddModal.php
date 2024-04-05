<?php

namespace App\Livewire\CustomerItem;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddModal extends Component
{
    use LivewireAlert;

    #[Validate('required', as: 'categoría')]
    public $categoryId='';

    #[Validate('required', as: 'nombre')]
    public $name;

    #[Validate('required', as: 'descripción')]
    public $description;

    #[Validate('required', as: 'stock')]
    public $stock;

    #[Validate('required', as: 'precio')]
    public $price;

    public function add()
    {
        $this->validate();

        $item=Item::create([
            'category_id' => $this->categoryId,
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'owner'=>'Cliente',
        ]);
        $item->customerItems()->create([
            'user_id' => Auth::user()->id,
            'item_id' => $item->id,
        ]);
        $item->delete();
        $this->reset();

        $this->dispatch('customer-item-saved');
        $this->alert('success', 'Nuevo producto agregado!', [
            'toast' => false,
            'position' => 'center',
            'timerProgressBar' => true,
            'timer' => 1500,
        ]);
    }
    public function render()
    {
        $data=[
            'categories' => Category::all(),
        ];
        return view('livewire.customer-item.add-modal', $data);
    }
}
