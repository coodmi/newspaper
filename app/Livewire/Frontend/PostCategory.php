<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Post;

#[Layout('components.layouts.frontend')]
class PostCategory extends Component
{

    public string $searchQuery;
    public $amount = 6;

    public function mount(string $searchQuery)
    {
        $this->searchQuery = $searchQuery;
    }

    public function updatingSearchQuery()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        // $this->resetPage();
        $this->amount += 6;
        
    }
    public function render()
    {
        $category = Category::where('slug', $this->searchQuery)->first();
        

        // If no matching category found, return empty posts
        if (! $category) {
            return view('livewire.frontend.post-category', [
                'posts' => collect(),
                'category' => $category,
            ]);
        }

        $posts = Post::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereDate('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->whereNotNull('featured_image')
            ->take($this->amount)
            ->get();

        $totalPosts = Post::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereDate('published_at', '<=', now())
            ->whereNotNull('featured_image')
            ->count();

        return view('livewire.frontend.post-category', [
            'posts' => $posts,
            'category' => $category,
            'hasMore' => $posts->count() < $totalPosts,
            
        ]);
    }

}