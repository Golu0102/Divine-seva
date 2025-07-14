<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pandit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'image',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ];

    // Relationship (if needed)
    public function poojas()
    {
        return $this->hasMany(Pooja::class);
    }
}
