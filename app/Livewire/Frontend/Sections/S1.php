<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Component;

class S1 extends Component
{
    public $section1;
     public function mount()
     {
        $this->section1 = Post::where('section', 1)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(3)
            ->get();
     }
    public function render()
    {
        return view('livewire.frontend.sections.s1');
    }
}