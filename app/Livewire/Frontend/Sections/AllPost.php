<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Post;
use Livewire\Component;

class AllPost extends Component
{
    /**
     * The initial number of posts to load.
     * @var int
     */
    public $amount = 8;

    /**
     * Increment the number of posts to load.
     */
    public function loadMore()
    {
        $this->amount += 4; // Increment by 5 on each click
    }

    /**
     * Render the component.
     */
    public function render()
    {
        // Create the base query that can be reused
        $postsQuery = Post::where('status', 'published')
            ->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->whereNotNull('featured_image');

        // ✨ Get the total count of all matching posts BEFORE applying any limit.
        // We clone the query builder object to avoid affecting the original query.
        $totalPosts = (clone $postsQuery)->count();
        
        // Fetch the posts for the current view using the dynamic $amount property.
        $section2Posts = (clone $postsQuery)
            ->take($this->amount)
            ->get();
        
        // Determine if there are more posts to load.
        // This is true if the number of posts we have fetched is less than the total available posts.
        $hasMore = $section2Posts->count() < $totalPosts;
        
        return view('livewire.frontend.sections.all-post', [
            'section2' => $section2Posts,
            'hasMore' => $hasMore,
        ]);
    }
}