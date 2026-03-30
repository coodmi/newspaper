<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'question',
        'status',
        'start_date',
        'end_date'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function options()
    {
        return $this->hasMany(\App\Models\PollOption::class);
    }

}