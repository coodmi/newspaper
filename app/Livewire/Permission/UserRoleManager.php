<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use App\Models\User;
use App\Traits\HasNotifications;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class UserRoleManager extends Component
{
   use WithPagination, HasNotifications;

   public $search = '';
   public $selectedRoles = [];
   public $editingUserId = null;

   public function render()
   {
      $users = User::with('roles')->when($this->search, function ($query) {
         $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('username', 'like', '%' . $this->search . '%');
      })->paginate(10);

      $roles = Role::all();

      return view('livewire.permission.user-role-manager', [
         'users' => $users,
         'roles' => $roles
      ]);
   }

   public function edit($userId)
   {
      $user = User::with('roles')->find($userId);
      $this->editingUserId = $userId;
      $this->selectedRoles = $user->roles->pluck('id')->toArray();
   }

   public function update()
   {
      $user = User::find($this->editingUserId);
      if (!empty($this->selectedRoles)) {
         $roles = Role::whereIn('id', $this->selectedRoles)->get();
         $user->syncRoles($roles);
      } else {
         $user->syncRoles([]);
      }

      $this->reset(['editingUserId', 'selectedRoles']);
      // session()->flash('message', 'User roles updated successfully.');
      $this->succsessNotify("User roles updated successfully!");
   }

   public function cancel()
   {
      $this->reset(['editingUserId', 'selectedRoles']);
   }
}