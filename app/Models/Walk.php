<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB; 
use App\Models\Pet;
use App\Models\Walker;
use App\Models\Route;
class Walk extends Authenticatable
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
        'user_id',
        
    ];

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route');
    }

    public function walker()
    {
        return $this->belongsTo(Walker::class, 'walker_id');
    }

    public static function searchUser ($walks){
        $query = DB::select('SELECT walks.*, users.* FROM users 
                            JOIN walks ON users.id = walks.user_id 
                            WHERE walks.user_id =:id', ['id' => $walks->user_id]);
        return $query;
    }

    public static function searchUsers(){
        $query = DB::select('SELECT walks.*, users.* FROM users 
                            JOIN walks ON users.id = walks.user_id');
        return $query;
    }

}

