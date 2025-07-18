<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'pooja_id',
        'name',
        'mobile',
        'email',
        'address',
        'date',
        'time',
        'status'
    ];

    public function pooja()
    {
        return $this->belongsTo(Pooja::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
