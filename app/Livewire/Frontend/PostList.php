<?php

namespace App\Livewire\Frontend;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.frontend')]
class PostList extends Component
{    
    public $amount = 6;

    public string $searchQuery;

    public function mount(string $searchQuery)
    {
        $this->searchQuery = $searchQuery;
    }

    public function loadMore()
    {
        // $this->resetPage();
        $this->amount += 6;
        
    }

    public function updatingSearchQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $baseQuery = Post::where(function ($query) {
                  $query->where('title', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('content', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('summary', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('keywords', 'like', '%' . $this->searchQuery . '%')
                        ->orWhereHas('user', function ($q) {
                                $q->where('name', 'like', '%' . $this->searchQuery . '%');
                        })
                ->orWhereHas('category', function ($q2) {
                        $q2->where('name', 'like', '%' . $this->searchQuery . '%');
                }); 
        })
        ->where('status', 'published')
        ->whereDate('published_at', '<=', now())
        ->whereNotNull('featured_image');

        // ✨ Total matching post count
        $totalPosts = (clone $baseQuery)->count();

        // ✨ Limited posts to display
        $posts = (clone $baseQuery)
            ->orderBy('published_at', 'desc')
            ->take($this->amount)
            ->get();

        return view('livewire.frontend.post-list', [
            'posts' => $posts,
            'hasMore' => $posts->count() < $totalPosts,
        ]);
    }

} 