<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // username = admin এর ইউজার পাওয়া
        $user = User::where('username', 'admin')->first();

        if (!$user) {
            $this->command->info('User with username "admin" not found.');
            return;
        }

        // superadmin রোল তৈরি বা নাও থাকতে পারে
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

        // ইউজারকে রোল অ্যাসাইন করা
        $user->assignRole($superAdminRole);

        $this->command->info('User "admin" assigned to superadmin role.');
    }
}