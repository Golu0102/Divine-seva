<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pandit extends Model
{
    protected $fillable = [
        'name', 'experience', 'bio', 'image'
    ];

    public function poojas()
    {
        return $this->hasMany(Pooja::class);
    }
}

