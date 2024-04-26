<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function paymenyDetails(): HasMany
    {
        return $this->hasMany(PaymentDetail::class);
    }
}
