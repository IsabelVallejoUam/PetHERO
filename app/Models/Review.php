<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Store;
class Review extends Model
{
    use HasFactory;

    protected $fillable = [

        'type',
        'commentary',
        'user_id',
        'walker_id',
        'product_id',
        'store_id',
        'rate'
    ];

    public function walker()
    {
        return $this->belongsTo(User::class, 'walker_id');
    }
    public function store()
    {
        return $this->belongsTo(User::class, 'store_id');
    }
    public function product()
    {
        return $this->belongsTo(User::class, 'product_id');
    }
}
