<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'name',
        'description',
        'photo',
        'quantity',
        'store_id',
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
