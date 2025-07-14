<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'logo',
        'footer_text',
        'address',
        'email',
        'mobile',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ];
}
