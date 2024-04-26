<?php

namespace App\Livewire\CustomerItem;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
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

    #[Validate('required | numeric | decimal:0', as: 'stock')]
    public $stock;

    #[Validate('required | numeric | decimal:0,1', as: 'precio')]
    public $price;

    public array $photos = [];

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

        foreach ($this->photos as $photo) {
            $path = Storage::disk('public')->putFile('photos', new File($photo['path']));
            $item->itemPics()->create([
                'url'=> basename($path),
            ]);
        }

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
