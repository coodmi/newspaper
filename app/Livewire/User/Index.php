<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Traits\HasNotifications;

class Index extends Component
{
    use HasNotifications;

    public $users;
    public $user = null;  // Default null, মনে রাখবে
    public $showEditModal = false;

    public $name;
    public $email;
    public $username;  // অবশ্যই থাকবে এখানে
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->users = User::all();
    }

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showEditModal = true;
    }

    public function editUser($id)
    {
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        // **Update ফর্মে username দেখাবেন না বলে এখানে সেট করো না** 
        $this->password = null;
        $this->password_confirmation = null;
        $this->showEditModal = true;
    }

    public function createUser()
    {
        $validated = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        $this->resetForm();
        $this->succsessNotify('User created successfully.');
    }

    public function updateUser()
    {
        $validated = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $this->user->update($validated);

        $this->resetForm();
        $this->succsessNotify('User updated successfully.');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        $this->users = User::all();
        $this->succsessNotify('User deleted successfully.');
    }

    public function resetForm()
    {
        // এখানে username রিসেট করতে ভুলবে না
        $this->reset([
            'user',
            'name',
            'email',
            'username',
            'password',
            'password_confirmation',
            'showEditModal',
        ]);

        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.user.index');
    }
}