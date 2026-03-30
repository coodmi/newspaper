<?php

namespace App\Livewire\Settings;

use App\Models\Post;
use App\Traits\ammountFormater;
use App\Traits\HasNotifications;
use App\Traits\HasBengaliNumbers;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use HasNotifications, WithPagination, HasBengaliNumbers, ammountFormater;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function formatToBengali($number)
    {
        // ধাপ ক: ammountFormater ট্রেইট থেকে সংখ্যা ফরম্যাট করা হয়
        $formattedNumber = $this->formatLakh($number);

        // ধাপ খ: HasBengaliNumbers ট্রেইট থেকে ফরম্যাটেড সংখ্যাটিকে বাংলায় রূপান্তর করা হয়
        return $this->convertToBengaliNumbers($formattedNumber);
    }
    public function render()
    {

                // ডাটাবেস থেকে পোস্টের সংখ্যা গণনা করা হচ্ছে
                $publishedPosts   = Post::where('status', 'published')->where('user_id', auth()->id())->count();
                $pendingPosts = Post::where('status', 'pending')->where('user_id', auth()->id())->count();
                $draftPosts   = Post::where('status', 'draft')->where('user_id', auth()->id())->count();

                $totalView = Post::where('user_id', auth()->id())->count('view_count');


        
        $posts = Post::query()
            ->when(
                $this->search,
                fn($query) =>
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('id', 'like', '%' . $this->search . '%');
                })
            )
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
            
        return view('livewire.settings.posts', [
            'pendingPosts' => $pendingPosts,
            'publishedPosts' => $publishedPosts,
            'draftPosts' => $draftPosts,
            'totalView' => $totalView,
            'posts' => $posts
        ]);
    }
}