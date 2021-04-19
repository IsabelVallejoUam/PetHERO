<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    *La llave primaria es la cedula y no es un auto-increment
    */
    public $incrementing = false;
    protected $primaryKey = 'document';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'document',
        'phone',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function petOwner()
    {
        return $this->hasOne(PetOwner::class);
    }

    public function walker()
    {
        return $this->hasOne(Walker::class);
    }

    public function storeOwner()
    {
        return $this->hasOne(StoreOwner::class);
    }

}
