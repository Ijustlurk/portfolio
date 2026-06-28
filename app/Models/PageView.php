<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $table = 'page_views';

    // Disable default updated_at column, since we only track created_at
    public $timestamps = false;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'path',
        'referer',
    ];
}
