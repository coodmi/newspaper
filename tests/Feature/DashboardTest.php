<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_with_permission_can_visit_dashboard()
    {
        // Create the required permission first
        Permission::firstOrCreate(['name' => 'admin.panel']);

        // Create a user and assign the permission
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $user->givePermissionTo('admin.panel');

        // Act as this user
        $this->actingAs($user);

        // Request dashboard and expect 200 OK
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }
}