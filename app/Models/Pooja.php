<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pooja extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'pandit_id'];


    public function pandit()
    {
        return $this->belongsTo(Pandit::class);
    }
}
