<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // fillable
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'order',
        'is_menu',
        'status',
        'slug',
        'home_category_show',
        'home_category_show_order',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Category model
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('is_menu', true);
    }
    
    // Category model all childrenn
    public function childrenAll()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', true);
    }
    

}