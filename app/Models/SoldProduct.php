<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'pet_owner_id',
        'bill_product_id'
    ];

    public function scopeOwnedBy($query, $store_id)
    {
        return $query->where('store_id', '=', $store_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'store_id');
    }
}
