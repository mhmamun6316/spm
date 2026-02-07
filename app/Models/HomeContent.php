<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    protected $table = 'home_contents';

    protected $fillable = [
        'title',
        'description',
        'text_position',
        'is_active',
        'sort_order',
        'type',
        'image',
        'image_position',
        'footer',
    ];
}
