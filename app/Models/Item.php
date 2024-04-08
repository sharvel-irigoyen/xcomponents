<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    protected $with=['customerItems'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function customerItems(): HasMany
    {
        return $this->hasMany(CustomerItem::class)->withTrashed();
    }
    public function itemPics(): HasMany
    {
        return $this->hasMany(ItemPic::class);
    }

    public function shoppingCartDetails(): HasMany
    {
        return $this->hasMany(ShoppingCartDetail::class);
    }
}
