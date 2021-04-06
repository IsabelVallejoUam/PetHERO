<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB; 
class Walker extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'experience',
        'schedule',
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
    

    public static function searchUser ($walker){
        $query = DB::select('SELECT walkers.*, users.* FROM users 
                            JOIN walkers ON users.id = walkers.id 
                            WHERE walkers.id =:id', ['id' => $walker->id]);
        return $query;
    }

    public static function searchUsers(){
        $query = DB::select('SELECT walkers.*, users.* FROM users 
                            JOIN walkers ON users.id = walkers.id');
        return $query;
    }
}
