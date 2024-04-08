<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class)->withTrashed();

    }
}
