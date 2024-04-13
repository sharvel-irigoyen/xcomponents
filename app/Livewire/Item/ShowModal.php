<?php

namespace App\Livewire\Item;

use App\Models\Item;
use Livewire\Component;

class ShowModal extends Component
{
    public Item $item;

    public function addCart(){
        
    }
    public function render()
    {
        return view('livewire.item.show-modal');
    }
}
