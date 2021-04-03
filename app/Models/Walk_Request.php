<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walk_Request extends Model
{
    use HasFactory;


    protected $fillable = [
        'requested_day',
        'minutes_walked',
        'route',
        'min_time',
        'max_time',
        'commentary'

    ];

    public const STATUS = [
        'pending'     => 1,
        'accepted'    => 2,
        'canceled'    => 3,
        'planned'     => 4
    ];

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
