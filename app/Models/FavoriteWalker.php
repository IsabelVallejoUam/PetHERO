<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB; 


class FavoriteWalker extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'pet_owner_id',
        'walker_id'
        
    ];

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('pet_owner_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}