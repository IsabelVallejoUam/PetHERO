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
        'age',
        'race',
        'personality',
        'commentary',
        'size',
        'species',
        'photo',
        'owner_id'
    ];


    public function scopeOwnedBy($query, $owner_id)
    {
        return $query->where('owner_id', '=', $owner_id);
    }

    public function owner()
    {
        return $this->belongsTo(PetOwner::class, 'owner_id');
    }

    public function walkRequests()
    {
        return $this->hasMany(Walks::class);
    }
}
