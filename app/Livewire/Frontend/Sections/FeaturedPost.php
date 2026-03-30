<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Component;

class FeaturedPost extends Component
{
    public $featuredPosts;

    public function mount()
    {
        sleep(2);
        $this->featuredPosts = Post::where('is_featured', 1)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(1)
            ->get();
    }
    public function render()
    {
        return view('livewire.frontend.sections.featured-post');
    }
}