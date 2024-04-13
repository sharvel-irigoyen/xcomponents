<?php

namespace App\Livewire\Item;

use App\Models\Item;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShowModal extends Component
{
    use LivewireAlert;
    public Item $item;

    public function addCart(Item $item)
    {
        $this->item=$item;
        $shoppingCart = ShoppingCart::where('user_id', Auth::user()->id)->first();

        if (!$shoppingCart) {
            $shoppingCart = ShoppingCart::create([
                'user_id' => Auth::user()->id,
            ]);
        }

        ShoppingCartDetail::create([
            'item_id' => $this->item->id,
            'shopping_cart_id' => $shoppingCart->id,
        ]);
        $this->item->delete();
        $this->dispatch('show-modal');
        $this->alert('success', 'Producto enviado al carrito', [
            'toast' => false,
            'position' => 'center',
            'timerProgressBar' => true,
            'timer' => 1500,
        ]);
    }
    public function render()
    {
        return view('livewire.item.show-modal');
    }
}
