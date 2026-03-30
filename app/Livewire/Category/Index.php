<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Traits\HasNotifications;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use HasNotifications;
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        try {
            $category->delete();
            $this->succsessNotify("Category deleted successfully!");
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Failed to delete category: " . $th->getMessage());
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, fn($query) =>
                $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orWhere('order', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%')
            )
            ->paginate(10);

        return view('livewire.category.index', [
            'categories' => $categories
        ]);
    }
}