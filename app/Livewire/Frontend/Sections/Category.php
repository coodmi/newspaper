<?php

namespace App\Livewire\Frontend\Sections;

use App\Models\Category as ModelsCategory;
use App\Models\Post;
use Livewire\Component;

class Category extends Component
{    
    
    public string $cetagories;
    public $sportsCenters;
    public $sportsLefts;
    public $sportsRights;

    public function mount()
    {

        // First find the main category (খেলা)
            $sportsCategory = ModelsCategory::where('name', $this->cetagories)->first();

        if ($sportsCategory) {
                // Get child category IDs (like ক্রিকেট, ফুটবল)
                    $childCategoryIds = $sportsCategory->childrenAll()->pluck('id')->toArray();

            // Combine parent ID and children IDs
                $categoryIds = array_merge([$sportsCategory->id], $childCategoryIds);

            $this->sportsCenters = Post::whereIn('category_id', $categoryIds)
                ->where('status', 'published')
                ->whereDate('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->whereNotNull('featured_image')
                ->take(1)
                ->get();

            $this->sportsLefts = Post::whereIn('category_id', $categoryIds)
                ->where('status', 'published')
                ->whereDate('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->whereNotNull('featured_image')
                ->skip(1)
                ->take(5)
                ->get();

            $this->sportsRights = Post::whereIn('category_id', $categoryIds)
            ->where('status', 'published')
            ->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->whereNotNull('featured_image')
            ->skip(6)
            ->take(3)
            ->get();
            
        }
    }
    public function render()
    {
        return view('livewire.frontend.sections.category');
    }
}