<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Component;

class Reel extends Component
{
    public function render()
    {
        $reels = Post::with('user')
               ->whereNotNull('video_url')
               ->where('status', 'published')
               ->latest('published_at')
               ->take(10)
               ->get();
            
               
        return view('livewire.frontend.sections.reel', ['reels' => $reels]);
    }
}