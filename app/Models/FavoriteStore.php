<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB; 


class FavoriteStore extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'user_id',
        'store_id'
        
    ];

    public static function searchStore ($user){
       
        $query = DB::select('SELECT * FROM stores
                            JOIN favorite_stores WHERE stores.id = favorite_stores.store_id 
                            AND favorite_stores.user_id =:id', ['id' => $user->id]);
        return $query;

    }

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}