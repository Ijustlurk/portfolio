<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $table = 'about_contents';

    protected $fillable = [
        'image_path',
        'image_scale',
        'image_offset_x',
        'image_offset_y',
        'text_content',
    ];
}
