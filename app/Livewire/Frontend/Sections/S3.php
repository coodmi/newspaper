<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Component;

class S3 extends Component
{
    public $section3;

    public function mount()
    {
        $this->section3 = Post::where('section', 3)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(9)
            ->get();
    }
    public function render()
    {
        return view('livewire.frontend.sections.s3');
    }
}