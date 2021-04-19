<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory;

    /*
    * Llave primaria es el nit de la tienda es una string
    */
    public $incrementing = false;
    protected $primaryKey = 'nit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'phone_number',
        'store_name',
        'nit',
        'description',
        'owner_id',
        'schedule',
    ];

    public function scopeOwnedBy($query, $owner_id)
    {
        return $query->where('owner_id', '=', $owner_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
