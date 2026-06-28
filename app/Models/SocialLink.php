<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'name',
        'url',
        'sort_order',
        'is_visible',
        'bg_color',
        'text_color'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];
}
