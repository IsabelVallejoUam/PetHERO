<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'duration',
        'price',
        'schedule'
    ];

    public function scopeOwnedBy($query, $owner_id)
    {
        return $query->where('owner_id', '=', $owner_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
