<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class FavoritePet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'pet_id',
        'walker_id'
        
    ];

    // public static function searcPet($user)
    // {


    //     $query = DB::table('favorite_walkers')
    //         ->join('walkers', 'favorite_walkers.walker_id', '=', 'walkers.user_id')
    //         ->join('users', 'favorite_walkers.walker_id', '=', 'users.id')
    //         ->where('favorite_walkers.pet_owner_id', $user->id)
    //         ->get();
    //     return $query;
    // }


    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('walker_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}