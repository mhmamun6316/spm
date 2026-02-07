<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'content',
        'image',
        'image_position',
        'list_items',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'list_items' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
