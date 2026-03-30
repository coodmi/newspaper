<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.frontend')]
class S4 extends Component
{
    public $section4;
    public function mount()
    {
        
        $this->section4 = Post::where('section', 4)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereNotNull('featured_image')
            ->take(8)
            ->get();
    }
    public function render()
    {
        return view('livewire.frontend.sections.s4');
    }
}