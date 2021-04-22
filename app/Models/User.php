<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

     /**
   * Users' roles
   * 
   * @var array
   */
   public const ROLES = [
    'pet owner'     => 1,
    'pet walker'    => 2,
    'store owner'  => 3
 ];

 public function pets()
 {
     return $this->hasMany(Pet::class);
 }

 public function walkerOwnership()
 {
     return $this->hasOne(Walker::class);
 }

 public function StoreOwnership()
 {
     return $this->hasOne(StoreOwner::class);
 }

 public function OwnerOwnership()
 {
     return $this->hasOne(PetOwner::class);
 }


}

