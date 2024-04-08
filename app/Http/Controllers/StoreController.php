<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $items=Item::where('owner', 'Tienda')->paginate(12);

        return view('store.index', compact('items'));
    }
}
