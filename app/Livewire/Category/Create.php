<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Traits\HasNotifications;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    use HasNotifications;
     
    public $name, $description, $parent_id, $order, $is_menu, $status, $image;
    public $categories;
    public $home_category_show = false;
    public $home_category_show_order = 0;
    
    public function mount()
    {
        $this->categories = Category::all();
    }

    public function refresh()
    {
        $this->reset(['name', 'description', 'parent_id', 'order', 'is_menu', 'status', 'home_category_show', 'home_category_show_order']);
    }
    
    public function submit()
    {
        $this->validate([
            'name' => 'required|min:3|unique:categories,name',
            'description' => 'required|min:3',
            'parent_id' => 'nullable|integer',
            'order' => 'required|integer',
            'is_menu' => 'required|integer',
            'status' => 'required|integer',
            'home_category_show' => 'required|integer',
            'home_category_show_order' => 'required|integer',
        ]);
        
        $category = new Category();
        $category->name = $this->name;
        $category->description = $this->description;
        $category->parent_id = $this->parent_id ?: null; // Convert empty string to null
        $category->order = $this->order;
        $category->is_menu = $this->is_menu;
        $category->status = $this->status;
        $category->slug = Str::slug($this->name);
        $category->home_category_show = $this->home_category_show;
        $category->home_category_show_order = $this->home_category_show_order;
        
        try {
            $category->save();
            $this->refresh();
            $this->succsessNotify("Categorie created succsess");
            return $this->redirect(route('categories.index'), navigate:true );
            
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Categorie create unsuccess");            
        }
    }
    public function render()
    {
        return view('livewire.category.create');
    }
}