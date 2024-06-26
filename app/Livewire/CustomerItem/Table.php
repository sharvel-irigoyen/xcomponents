<?php

namespace App\Livewire\CustomerItem;

use App\Models\CustomerItem;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $listeners = [
        'delete'
    ];

    public CustomerItem $customerItem;
    public function deleteConfirmation(CustomerItem $customerItem)
    {
        $this->customerItem=$customerItem;
        $this->alert('warning', '¿Estás seguro que deseas eliminar este producto?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Sí',
            'onConfirmed' => 'delete',
            'showCancelButton' => true,
            'cancelButtonText' => 'No',
            'toast' => false,
            'position' => 'center',
            'timer' => null,
        ]);
    }
    public function delete()
    {
        try {
            $this->customerItem->item->forceDelete();
            $this->alert('success', 'Producto eliminado', [
                'toast' => false,
                'position' => 'center',
                'timerProgressBar' => true,
                'timer' => 1500,
            ]);
        } catch (\Throwable $th) {
            if ($th->errorInfo[1] == 1451) {
                $this->alert('error', 'No puedes eliminar este registro debido a que existen tablas asociados a este', [
                    'toast' => false,
                    'position' => 'center',
                    'timerProgressBar' => true,
                    'timer' => 4000,
                ]);
            }
        }
    }
    public function addCart(CustomerItem $customerItem){
        $this->customerItem=$customerItem;
        $shoppingCart = ShoppingCart::where('user_id', Auth::user()->id)->first();

        if (!$shoppingCart) {
            $shoppingCart = ShoppingCart::create([
                'user_id' => Auth::user()->id,
            ]);
        }

        ShoppingCartDetail::create([
            'item_id' => $this->customerItem->item->id,
            'shopping_cart_id' => $shoppingCart->id,
        ]);
        $this->customerItem->delete();

        $this->alert('success', 'Producto enviado al carrito', [
            'toast' => false,
            'position' => 'center',
            'timerProgressBar' => true,
            'timer' => 1500,
        ]);
    }
    public function render()
    {
        $data=[
            'customerItems'=>CustomerItem::where('user_id', Auth::user()->id)->orderBy('updated_at','desc')
            ->paginate(10),
        ];
        return view('livewire.customer-item.table', $data);
    }
}
