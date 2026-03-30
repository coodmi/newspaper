<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    //
    use HasFactory;
protected $fillable = [
    'title',
    'favicon',
    'logo',
    'meta_tags',
    'meta_description',
    'fb_app_id',
    'adsense_publisher_id',
    'youtube_url',
    'facebook_url',
    'twitter_url',
    'instagram_url',
    'reddit_url',
    'google_news_url',
    'linkedin_url',
    'mailer',
    'host',
    'port',
    'username',
    'password',
    'encryption',
    'from_address',
    'from_name',
    'terms',
    'privacy',
    'contact',
    'about',
    'editor',
];
}