<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class WalkRequest extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'requested_day',
        'minutes_walked',
        'route',
        'min_time',
        'max_time',
        'commentary',
        'status',
        'walker',
        
    ];

    protected $status=[
        ["estado" => "pending"],
        ["estado" => "active"],
        ["estado" => "finished"],
        ["estado" => "canceled"],

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

