<?php

namespace App\Livewire\Item;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;
    public function render()
    {
        $data=[
            'items'=>Item::where('owner', 'Tienda')
            ->withCount('itemPics')
            ->orderByRaw('ISNULL(item_pics_count), item_pics_count DESC')
            ->paginate(12)
        ];
        return view('livewire.item.index', $data);
    }
}
