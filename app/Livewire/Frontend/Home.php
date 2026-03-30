<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use App\Traits\HasBengaliNumbers;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.frontend')]
class Home extends Component

{
    use HasBengaliNumbers;
    public $featuredPosts;
    public $letetstPosts;
    public $todayBestPosts;
    public $weekBestPosts;
    public $section1;
    public $section2;
    public $section3;
    public $AsideCarousels;
    public $CategoriesShowPosts;
    public $section4;
    public $section5;

    public function mount()
    {
         
        $this->featuredPosts = Post::where('is_featured', 1)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(1)
            ->get();
                       
        $this->letetstPosts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(10)
            ->get();

        $this->todayBestPosts = Post::where('status', 'published')
            ->whereDate('published_at', now())
            ->orderByDesc('view_count')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(10)
            ->get();
    
        $this->weekBestPosts = Post::where('status', 'published')
            ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderByDesc('view_count')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(10)
            ->get();
        
        $this->section3 = Post::where('section', 3)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(9)
            ->get();
        
        
        $this->AsideCarousels = Post::where('is_slider', '2')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->take(5)
            ->get();

        $this->CategoriesShowPosts = Category::where('home_category_show', 1)
            ->where('status', 1)
            ->orderBy('home_category_show_order', 'asc')
            ->get();

        
    }
    public function render()
    {
            
        return view('livewire.frontend.home');
    }
}