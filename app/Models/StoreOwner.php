<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoreOwner extends Model
{
    use HasFactory;


    protected $primaryKey = 'user_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
        'user_id'
    ];

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function searchUser ($user_id){
        $query = DB::select('SELECT store_owners.*, users.* FROM users 
                            JOIN store_owners ON users.id = store_owners.user_id 
                            WHERE store_owners.user_id =:id', ['id' => $user_id]);
        return $query;
    }

    public static function searchUsers(){
        $query = DB::select('SELECT store_owners.*, users.* FROM users 
                            JOIN store_owners ON users.id = store_owners.user_id');
        return $query;
    }
}
