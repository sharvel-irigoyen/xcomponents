<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ShoppingCart extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function shoppingCartDetails(): HasMany
    {
        return $this->hasMany(ShoppingCartDetail::class);
    }
}
