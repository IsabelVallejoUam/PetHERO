<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'pet_owner_id'
    ];

    public function scopeOwnedBy($query, $pet_owner_id)
    {
        return $query->where('pet_owner_id', '=', $pet_owner_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'pet_owner_id');
    }
}
