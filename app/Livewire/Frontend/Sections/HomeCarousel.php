<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Component;

class HomeCarousel extends Component
{
    public $HomeCarousels;
    public function mount()
    {
        // sleep(1);
       $this->HomeCarousels = Post::where('is_slider', '1')
           ->where('status', 'published')
           ->orderBy('published_at', 'desc')
           ->whereDate('published_at', '<=', now())
           ->whereNotNull('featured_image')
           ->take(16)
           ->get();
    }
    public function render()
    {
        return view('livewire.frontend.sections.home-carousel');
    }
}