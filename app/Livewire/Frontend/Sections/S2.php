<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Component;

class S2 extends Component
{
    public $section2;

    public function mount()
    {
        $this->section2 = Post::where('section', 2)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(8)
            ->get();
    }
    public function render()
    {
        return view('livewire.frontend.sections.s2');
    }
}