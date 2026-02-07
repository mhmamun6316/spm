<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission',
        'values',
        'company_name',
        'address',
        'phone',
        'email',
        'website',

        // Footer fields
        'footer_description',
        'facebook_url',
        'linkedin_url',
        'twitter_url',
        'youtube_url',
        'instagram_url',
        'footer_contact_email',
        'uk_address',
        'uk_email',
        'hq_address',
        'hq_email',
        'nz_address',
        'nz_email',
        'copyright_text',
    ];
}
