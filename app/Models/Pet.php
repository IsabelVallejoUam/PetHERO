<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sex',
        'birthday',
        'race',
        'personality',
        'commentary',
        'size',
        'type'
    ];

    public const SIZES = [
        'tiny'     => 1,
        'small'    => 2,
        'medium'  => 3,
        'large'  => 4,
        'giant'  => 5
     ];

     public const PERSONALITIES = [
        'calm'     => 1,
        'friendly'    => 2,
        'aggressive'  => 3,
        'shy'  => 4,
     ];

     public const TYPE = [
        'dog'     => 1,
        'cat'    => 2,
     ];

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
