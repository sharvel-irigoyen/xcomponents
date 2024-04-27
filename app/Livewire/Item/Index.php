<?php

namespace App\Livewire\Item;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    public $filters = [
        'name' => '',
        'description' => '',
        'priceMin' => null,
        'priceMax' => null,
        'category' => [],
    ];

    public function updatedFilters()
    {
        $this->resetPage();
    }
    public function render()
    {
        $data=[
            // 'items'=>Item::where('owner', 'Tienda')
            // ->withCount('itemPics')
            // ->orderByRaw('ISNULL(item_pics_count), item_pics_count DESC')
            // ->paginate(12)
            'categories' =>Category::all(),
            'items'=>Item::filter($this->filters)->where('owner', 'Tienda')->withCount('itemPics')
            ->orderByRaw('ISNULL(item_pics_count), item_pics_count DESC')->paginate(12)
        ];
        return view('livewire.item.index', $data);
    }
}
