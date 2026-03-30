<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // fillable properties
    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'summary',
        'content',
        'featured_image',
        'image_caption',
        'video_url',
        'keywords',
        'category_id',
        'status',
        'is_featured',
        'is_breaking',
        'is_slider',
        'section',
        'published_at',
        'meta_title',
        'meta_description',
        'user_id',
        'poll_id',
        'view_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
