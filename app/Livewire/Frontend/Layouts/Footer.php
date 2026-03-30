<?php

namespace App\Livewire\Frontend\Layouts;

use App\Models\Category;
use App\Models\Post;
use App\Models\website;
use Livewire\Component;

class Footer extends Component
{
    public $letestPosts;
    public $letestPosts2;
    public $category;
    public $website;
    public function mount()
    {

        $website = website::first();
        if($website){
            $this->website = $website;
        }
        
       $this->letestPosts = Post::where('status', 'published')
           ->orderBy('published_at', 'desc')
           ->whereDate('published_at', '<=', now())
           ->whereNotNull('featured_image')
           ->where('featured_image', '!=', null)
           ->take(3)
           ->get();
           
        $this->letestPosts2 = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->where('featured_image', '!=', null)
            ->skip(3)
            ->take(3)
            ->get();

        $this->category = Category::where('status', 1)
            ->where('is_menu', 1)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }
    public function render()
    {
        return view('livewire.frontend.layouts.footer');
    }
}