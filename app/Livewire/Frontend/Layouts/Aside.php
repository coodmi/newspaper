<?php

namespace App\Livewire\Frontend\Layouts;

use App\Models\Post;
use App\Traits\HasBengaliNumbers;
use Livewire\Component;

class Aside extends Component
{
    use HasBengaliNumbers;
    public $AsideCarousels;
    public $letetstPosts;
    public $todayBestPosts;
    public $weekBestPosts;
    
    
    public function mount()
    { 
       $this->AsideCarousels = Post::where('is_slider', '2')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->take(5)
            ->get();
            
        $this->letetstPosts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->where('status', 'published')
            ->whereDate('published_at', '<=', now())
            ->take(10)
            ->get();

        $this->todayBestPosts = Post::where('status', 'published')
            ->whereDate('published_at', now())
            ->orderByDesc('view_count')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->take(10)
            ->get();

        $this->weekBestPosts = Post::where('status', 'published')
            ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderByDesc('view_count')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->take(10)
            ->get();
    }
    public function render()
    {
        return view('livewire.frontend.layouts.aside');
    }
}