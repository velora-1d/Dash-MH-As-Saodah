<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\SchoolSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_users_with_correct_roles()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Asumsi rute settings.users.create dilindungi role:admin,kepsek
        $response = $this->actingAs($admin)->get(route('settings.users.create'));
        
        $response->assertStatus(200);
    }

    /** @test */
    public function it_blocks_users_with_incorrect_roles()
    {
        $operator = User::factory()->create(['role' => 'operator']);
        
        // Asumsi rute settings.users.create melarang operator
        $response = $this->actingAs($operator)->get(route('settings.users.create'));
        
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error');
    }
}
