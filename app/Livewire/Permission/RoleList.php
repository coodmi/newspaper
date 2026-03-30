<?php

namespace App\Livewire\Permission;

use App\Traits\HasNotifications;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class RoleList extends Component
{
   use WithPagination, HasNotifications;

   public $search = '';
   public $name = '';
   public $guard_name = 'web';
   public $editingRoleId = null;
   public $selectedPermissions = [];

   protected $rules = [
      'name' => 'required|min:3|unique:roles,name',
      'guard_name' => 'required',
      'selectedPermissions' => 'array'
   ];

   public function render()
   {
      $roles = Role::when($this->search, function ($query) {
         $query->where('name', 'like', '%' . $this->search . '%');
      })->paginate(10);

      $permissions = Permission::all();

      return view('livewire.permission.role-list', [
         'roles' => $roles,
         'permissions' => $permissions
      ]);
   }

   public function create()
   {
      $this->validate();

      $role = Role::create([
         'name' => $this->name,
         'guard_name' => $this->guard_name
      ]);

      if (!empty($this->selectedPermissions)) {
         $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();
         $role->syncPermissions($permissions);
      }

      $this->reset(['name', 'guard_name', 'selectedPermissions']);
      // session()->flash('message', 'Role created successfully.');
      $this->succsessNotify("Role created successfully!");
   }

   public function edit($id)
   {
      $role = Role::find($id);
      $this->editingRoleId = $id;
      $this->name = $role->name;
      $this->guard_name = $role->guard_name;
      $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
   }

   public function update()
   {
      $this->validate([
         'name' => 'required|min:3|unique:roles,name,' . $this->editingRoleId,
         'guard_name' => 'required',
         'selectedPermissions' => 'array'
      ]);

      $role = Role::find($this->editingRoleId);
      $role->update([
         'name' => $this->name,
         'guard_name' => $this->guard_name
      ]);

      if (!empty($this->selectedPermissions)) {
         $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();
         $role->syncPermissions($permissions);
      } else {
         $role->syncPermissions([]);
      }

      $this->reset(['name', 'guard_name', 'selectedPermissions', 'editingRoleId']);
      // session()->flash('message', 'Role updated successfully.');
      $this->succsessNotify("Role updated successfully!");
   }

   public function delete($id)
   {
      Role::find($id)->delete();
      // session()->flash('message', 'Role deleted successfully.');
      $this->succsessNotify("Role deleted successfully!");
   }
}