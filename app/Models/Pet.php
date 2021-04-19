<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'sex',
        'birthday',
        'race',
        'personality',
        'commentary',
        'size',
        'specie',
        'owner_id',

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

     public const SPECIES = [
        'dog'     => 1,
        'cat'    => 2,
     ];

    public function scopeOwnedBy($query, $owner_id)
    {
        return $query->where('owner_id', '=', $owner_id);
    }

    public function owner()
    {
        return $this->belongsTo(PetOwner::class, 'owner_id');
    }
}
