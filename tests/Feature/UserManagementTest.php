<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

use App\Models\SchoolSetting;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_access_settings_dashboard()
    {
        SchoolSetting::create(['name' => 'Testing Madrasah']);
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('settings.index'));
        $response->assertStatus(200);
        $response->assertViewIs('settings.index');
    }

    /** @test */
    public function kepsek_can_access_settings_dashboard()
    {
        SchoolSetting::create(['name' => 'Testing Madrasah']);
        $kepsek = User::factory()->create(['role' => 'kepsek']);

        $response = $this->actingAs($kepsek)->get(route('settings.index'));
        $response->assertStatus(200);
        $response->assertViewIs('settings.index');
    }

    /** @test */
    public function other_roles_cannot_access_user_management_pages()
    {
        $operator = User::factory()->create(['role' => 'operator']);
        
        $response = $this->actingAs($operator)->get(route('settings.users.create'));
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error');
    }

    /** @test */
    public function admin_can_create_a_new_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $userData = [
            'name' => 'Guru Baru',
            'username' => 'gurubaru123',
            'email' => 'guru@example.com',
            'role' => 'operator',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->actingAs($admin)->post(route('settings.users.store'), $userData);
        
        $response->assertRedirect(route('settings.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'guru@example.com',
            'username' => 'gurubaru123',
            'role' => 'operator'
        ]);
    }

    /** @test */
    public function admin_can_update_another_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $targetUser = User::factory()->create(['role' => 'operator']);
        
        $updateData = [
            'name' => 'Updated Name',
            'username' => 'updated_username',
            'email' => 'updated@example.com',
            'role' => 'bendahara',
        ];

        $response = $this->actingAs($admin)->put(route('settings.users.update', $targetUser), $updateData);
        
        $response->assertRedirect(route('settings.index'));
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => 'Updated Name',
            'role' => 'bendahara' // Role diizinkan diubah karena bukan akun sendiri
        ]);
    }

    /** @test */
    public function user_cannot_change_their_own_role()
    {
        $admin = User::factory()->create(['role' => 'admin', 'username' => 'admin123', 'email' => 'admin@admin.com']);
        
        $updateData = [
            'name' => 'Admin Baru Name',
            'username' => 'admin123', // Sama
            'email' => 'admin@admin.com', // Sama
            'role' => 'operator', // Berusaha menurunkan pangkat diri sendiri
        ];

        $response = $this->actingAs($admin)->put(route('settings.users.update', $admin), $updateData);
        
        $response->assertRedirect(route('settings.index'));
        
        // Memastikan nama terupdate tapi ROLE TIDAK TERUPDATE
        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'name' => 'Admin Baru Name',
            'role' => 'admin', // Role harus tetap admin
        ]);
        
        // Pastikan tidak ada rekor dengan role 'operator' masuk untuk user ini
        $this->assertDatabaseMissing('users', [
            'id' => $admin->id,
            'role' => 'operator',
        ]);
    }

    /** @test */
    public function admin_can_toggle_user_status()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $targetUser = User::factory()->create(['role' => 'operator', 'status' => 'aktif']);
        
        $response = $this->actingAs($admin)->post(route('settings.users.toggle', $targetUser));
        
        $response->assertRedirect();
        
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'status' => 'nonaktif',
        ]);
    }
}
