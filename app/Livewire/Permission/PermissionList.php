<?php

namespace App\Livewire\Permission;

use App\Traits\HasNotifications;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class PermissionList extends Component
{
   use WithPagination, HasNotifications;

   public $search = '';
   public $name = '';
   public $guard_name = 'web';
   public $editingPermissionId = null;

   protected $rules = [
      'name' => 'required|min:3|unique:permissions,name',
      'guard_name' => 'required'
   ];

   public function render()
   {
      $permissions = Permission::when($this->search, function ($query) {
         $query->where('name', 'like', '%' . $this->search . '%');
      })->paginate(10);

      return view('livewire.permission.permission-list', [
         'permissions' => $permissions
      ]);
   }

   public function create()
   {
      $this->validate();

      Permission::create([
         'name' => $this->name,
         'guard_name' => $this->guard_name
      ]);

      $this->reset(['name', 'guard_name']);
      // session()->flash('message', 'Permission created successfully.');
      $this->succsessNotify("Permission create successfully!");
   }

   public function edit($id)
   {
      $permission = Permission::find($id);
      $this->editingPermissionId = $id;
      $this->name = $permission->name;
      $this->guard_name = $permission->guard_name;
   }

   public function update()
   {
      $this->validate([
         'name' => 'required|min:3|unique:permissions,name,' . $this->editingPermissionId,
         'guard_name' => 'required'
      ]);

      $permission = Permission::find($this->editingPermissionId);
      $permission->update([
         'name' => $this->name,
         'guard_name' => $this->guard_name
      ]);

      $this->reset(['name', 'guard_name', 'editingPermissionId']);
      // session()->flash('message', 'Permission updated successfully.');
      $this->succsessNotify("Permission updated successfully!");
   }

   public function delete($id)
   {
      Permission::find($id)->delete();
      // session()->flash('message', 'Permission deleted successfully.');
      $this->succsessNotify("Permission deleted successfully!");
   }
}