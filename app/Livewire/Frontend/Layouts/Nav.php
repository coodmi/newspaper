<?php

namespace App\Livewire\Frontend\Layouts;

use App\Models\Category;
use Livewire\Component;

class Nav extends Component
{    
    public $menuCategories;
    public $logo;
    public $searchQuery;
    
    public function mount()
    {
        $this->menuCategories = Category::where('is_menu', true)
            ->where('status', true)
            ->whereNull('parent_id')
            ->with(['children' => function ($q) {
                    $q->where('is_menu', true)
                    ->orderBy('order')
                    ->where('status', true);
                }])
            ->orderBy('order')
            ->get();
    }
    public function searchPost()
    {
        $this->validate([
            'searchQuery' => 'required|min:3|max:100',
        ], [
            'searchQuery.required' => 'Search query is required.',
            'searchQuery.min' => 'Search query must be at least 3 characters.',
            'searchQuery.max' => 'Search query cannot exceed 100 characters.',
        ]);

        return $this->redirect(route('search.post', ['searchQuery' => $this->searchQuery]), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.frontend.layouts.nav');
    }
}