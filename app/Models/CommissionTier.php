<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionTier extends Model
{
    protected $fillable = [
        'render_quality',
        'coverage_type',
        'price',
        'delivery_time',
        'resolution',
        'dpi',
        'tools',
        'slots_available',
        'image_path',
        'feature_high_res',
        'feature_revisions',
        'feature_background',
        'feature_commercial',
        'feature_source_file',
        'feature_urgent',
    ];

    protected $casts = [
        'feature_high_res' => 'boolean',
        'feature_revisions' => 'boolean',
        'feature_background' => 'boolean',
        'feature_commercial' => 'boolean',
        'feature_source_file' => 'boolean',
        'feature_urgent' => 'boolean',
    ];
}
