<?php

namespace App\Livewire\CustomerShoppingCart;

use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

    public ShoppingCartDetail $shoppingCartDetail;
    public $totalPrice;

    public function deleteConfirmation(ShoppingCartDetail $shoppingCartDetail)
    {
        $this->shoppingCartDetail=$shoppingCartDetail;
        $this->alert('warning', '¿Estás seguro que deseas eliminar este producto del carrito?', [
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
            if ($this->shoppingCartDetail->item->owner=="Tienda") {
                $this->shoppingCartDetail->item->restore();
                $this->shoppingCartDetail->delete();

                $this->alert('success', 'Producto regresado a la Tienda', [
                    'toast' => false,
                    'position' => 'center',
                    'timerProgressBar' => true,
                    'timer' => 1500,
                ]);
            } else {
                $this->shoppingCartDetail->item->customerItems->first()->restore();
                $this->shoppingCartDetail->delete();

                $this->alert('success', 'Producto regresado a tus productos', [
                    'toast' => false,
                    'position' => 'center',
                    'timerProgressBar' => true,
                    'timer' => 1500,
                ]);
            }


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
    public function updatePrice()
    {

        $shoppingCartDetails = ShoppingCart::where('user_id', Auth::user()->id)->first()->shoppingCartDetails;

        $totalStorePrice = $shoppingCartDetails->where('item.owner', 'Tienda')->sum('item.price');
        $totalCustomerPrice =  $shoppingCartDetails->where('item.owner', 'Cliente')->sum('item.price');

        $totalPrice = $totalStorePrice - $totalCustomerPrice;
        $shoppingCartDetails->first()->shoppingCart->update([
            'total_price' => $totalPrice
        ]);

    }

    public function generateSessionToken()
    {
        $auth= base64_encode(config('services.niubiz.user'). ':' . config('services.niubiz.password'));
        $accessToken=Http::withHeaders([
            'Authorization' =>"Basic $auth",
        ])
        ->get(config('services.niubiz.url_api'). '/api.security/v1/security')
        ->body();

        $sessionToken=Http::withHeaders([
            'Authorization' =>$accessToken,
            'Content-Type' => 'application/json',
        ])
        ->post(config('services.niubiz.url_api').'/api.ecommerce/v2/ecommerce/token/session/'.config('services.niubiz.merchant_id'), [
            'channel' =>'web',
            'amount' =>100,
            "antifraud"=> [
                "clientIp"=>request()->ip(),
                "merchantDefineData"=> [
                "MDD4"=> auth()->user()->email,
                "MDD21"=> 0,
                "MDD32"=> auth()->user()->id,
                "MDD75"=> "Registrado",
                "MDD77"=> now()->diffInDays(auth()->user()->created_at)+1,
                ]
            ]
        ])->json();

        return $sessionToken['sessionKey'];
    }
    public function render()
    {
        $this->updatePrice();
        $data=[
            'shoppingCartDetails'=>ShoppingCart::where('user_id', Auth::user()->id)->first()->shoppingCartDetails()->orderBy('updated_at', 'desc')
            ->paginate(10),
            'shoppingCart'=>ShoppingCart::where('user_id', Auth::user()->id)->first(),
            'sessionToken'=>$this->generateSessionToken(),
        ];
        return view('livewire.customer-shopping-cart.table', $data);
    }
}
