<?php

namespace App\Livewire\CustomerItem;

use App\Models\Category;
use App\Models\CustomerItem;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditModal extends Component
{
    use LivewireAlert;

    public CustomerItem $customerItem;

    #[Validate('required', as: 'categoría')]
    public $categoryId;

    #[Validate('required', as: 'nombre')]
    public $name;

    #[Validate('required', as: 'descripción')]
    public $description;

    #[Validate('required | numeric | decimal:0', as: 'stock')]
    public $stock;

    #[Validate('required | numeric | decimal:0,1', as: 'precio')]
    public $price;

    public function mount()
    {
        $this->categoryId=$this->customerItem->item->category->id;
        $this->name=$this->customerItem->item->name;
        $this->description=$this->customerItem->item->description;
        $this->stock=$this->customerItem->item->stock;
        $this->price=$this->customerItem->item->price;
    }
    public function edit()
    {
        $this->validate();
        $this->customerItem->item->update([
            'category_id' => $this->categoryId,
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
        ]);

        $this->dispatch('customer-item-saved');
        $this->alert('success', 'Producto editado!', [
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
        return view('livewire.customer-item.edit-modal', $data);
    }
}
