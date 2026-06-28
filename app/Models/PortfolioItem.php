<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'section',
        'type',
        'image_path',
        'pages',
        'reading_direction',
        'image_scale',
        'image_offset_x',
        'image_offset_y',
        'timelapse_path',
        'sort_order',
    ];

    protected $casts = [
        'pages' => 'array',
    ];
}
