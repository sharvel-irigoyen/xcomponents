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

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['name'], function ($query, $name) {
            $names = explode(' ', $name);

            foreach ($names as $na) {
                $query->where('name', 'like', '%' . $na . '%');
            }
        })

        ->when($filters['description'], function ($query, $description) {
            $descriptions = explode(' ', $description);

            foreach ($descriptions as $des) {
                $query->where('description', 'like', '%' . $des . '%');
            }
        })

        ->when($filters['priceMin'], fn ($query, $price)
        => $query->where('price', '>=', $price))
        ->when($filters['priceMax'], fn ($query, $price)
         => $query->where('price', '<=', $price))
        ->when($filters['category'], fn ($query, $category)
         => $query->whereIn('category_id', $category));
    }
}
