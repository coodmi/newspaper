<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions without serial numbers
        $permissions = [

            // Posts
            'post.create',
            'post.maintenance',
            'post.published',

            // Polls
            'polls.create',
            'polls.edit',

            // Categories
            'categories.edit',

            // User/Admin
            'user.permission',
            'user.edit',
            'admin.panel',
            'dashboard',
            'website.maintenance',

            // Ads
            'ads',
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Create a role and assign all permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $superAdminRole->syncPermissions($permissions);

        // Editor role
        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editorRole->syncPermissions([
            'post.create',
            'post.maintenance',
            'post.published',
            'categories.edit',
        ]);

        // Reporter role
        $reporterRole = Role::firstOrCreate(['name' => 'reporter', 'guard_name' => 'web']);
        $reporterRole->syncPermissions([
            'post.create',
        ]);
    }
}