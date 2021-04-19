<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class Walker extends Model
{
    use HasFactory;

    
    /*
    * Llave primaria es el id del usario dueño del rol es una string
    */
    public $incrementing = false;
    protected $primaryKey = 'user_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'experience',
        'schedule',
        'user_id',
        'rate'
        
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
                            JOIN walkers ON users.id = walkers.user_id 
                            WHERE walkers.user_id =:id', ['id' => $walker->user_id]);
        return $query;
    }

    public static function searchUsers(){
        $query = DB::select('SELECT walkers.*, users.* FROM users 
                            JOIN walkers WHERE users.id = walkers.user_id');
        return $query;
    }
}
