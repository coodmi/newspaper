<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Traits\HasNotifications;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    use HasNotifications;
    
    public $categoryId;
    public $name;
    public $description;
    public $parent_id;
    public $order = 0;
    public $is_menu = 1;
    public $status = 1;
    public $categories;
    public $home_category_show = 1;
    public $home_category_show_order = 0;

    public function mount($id)
    {   
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        $this->order = $category->order ?? 0;
        $this->is_menu = $category->is_menu ?? 1;
        $this->status = $category->status ?? 1;
        $this->home_category_show = $category->home_category_show ?? 1;
        $this->home_category_show_order = $category->home_category_show_order ?? 0;

        // Load all categories except current one to avoid selecting itself as parent
        $this->categories = Category::where('id', '!=', $this->categoryId)->get();
    }

    public function update()
    {
        try {
            $this->validate([
                'name' => ['required', Rule::unique('categories', 'name')->ignore($this->categoryId)],
                'description' => ['nullable', 'string'],
                // 'parent_id' => ['nullable', 'exists:categories,id'],
                'parent_id' => 'nullable',
                'order' => ['nullable', 'integer', 'min:0'],
                'is_menu' => ['required', 'boolean'],
                'status' => ['required', 'boolean'],
                'home_category_show' => ['required', 'boolean'],
                'home_category_show_order' => ['required', 'integer'],
                
            ]);

            $category = Category::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'description' => $this->description,
                'parent_id' => $this->parent_id !== '' ? $this->parent_id : null,
                'order' => $this->order,
                'is_menu' => $this->is_menu,
                'status' => $this->status,
                'home_category_show' => $this->home_category_show,
                'home_category_show_order' => $this->home_category_show_order,
            ]);

            $this->succsessNotify("Category updated successfully!");
            return $this->redirect(route('categories.index'), navigate:true);
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Failed to update category: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.category.edit');
    }
}