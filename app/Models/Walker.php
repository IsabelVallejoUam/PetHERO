<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class Walker extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'experience',
        'slogan',
        'rate',
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


    public static function searchUser($walker)
    {
        $query = DB::table('SELECT walkers.*, users.* FROM users 
                            JOIN walkers ON users.id = walkers.user_id 
                            WHERE walkers.user_id =:id', ['id' => $walker->user_id]);
        return $query;
    }

    public static function searchUsers($request)
    {
        $query = User::where([
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term  . '%');
                }
            }]
        ])
            ->join('walkers', 'users.id', '=', 'walkers.user_id')
            ->select('walkers.*', 'users.*')
            ->get();

        return $query;
    }


    public static function searchActiveWalkers($walker_id)
    {
        $query = DB::select('SELECT walkers.* FROM routes as r 
                            JOIN w ON w.id = r.owner_id 
                            WHERE w.user_id =:id', ['id' => $walker_id]);
        return $query;
    }

    
}
