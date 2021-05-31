<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'bill_id'
    ];

    public function scopeOwnedBy($query, $bill_id)
    {
        return $query->where('bill_id', '=', $bill_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'bill_id');
    }
}
