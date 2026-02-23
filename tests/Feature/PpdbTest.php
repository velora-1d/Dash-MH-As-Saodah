<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\PpdbRegistration;
use App\Models\AcademicYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpdbTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Buat tahun ajaran aktif
        AcademicYear::factory()->create([
            'is_active' => true,
        ]);
    }

    public function test_admin_can_view_ppdb_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('ppdb.index'));

        $response->assertStatus(200);
        $response->assertViewIs('ppdb.index');
    }

    public function test_user_cannot_view_ppdb_if_not_authenticated(): void
    {
        $response = $this->get(route('ppdb.index'));

        $response->assertRedirect('/login');
    }

    public function test_kepsek_can_approve_ppdb(): void
    {
        $entity = \App\Models\Entity::create(['name' => 'MI As-Saodah Entity']);
        $unit = \App\Models\Unit::create(['name' => 'MI As-Saodah', 'entity_id' => $entity->id]);
        
        $kepsek = User::factory()->create(['role' => 'kepsek']);
        \App\Models\UserScope::create([
            'user_id' => $kepsek->id,
            'entity_id' => $entity->id,
            'unit_id' => $unit->id,
            'role' => 'kepsek'
        ]);

        $ppdb = PpdbRegistration::create([
            'student_name' => 'Calon Siswa',
            'gender' => 'L',
            'academic_year_id' => AcademicYear::where('is_active', true)->first()->id,
            'status' => 'pending',
            'unit_id' => $unit->id,
            'entity_id' => $entity->id,
            'registration_number' => 'PPDB-2023-001'
        ]);

        $response = $this->actingAs($kepsek)->post(route('ppdb.approve', $ppdb));

        $response->assertRedirect();
        $this->assertDatabaseHas('ppdb_registrations', [
            'id' => $ppdb->id,
            'status' => 'diterima',
        ]);
    }

    public function test_operator_cannot_approve_ppdb(): void
    {
        $entity = \App\Models\Entity::create(['name' => 'MI As-Saodah Entity']);
        $unit = \App\Models\Unit::create(['name' => 'MI As-Saodah', 'entity_id' => $entity->id]);

        $operator = User::factory()->create(['role' => 'operator']);
        \App\Models\UserScope::create([
            'user_id' => $operator->id,
            'entity_id' => $entity->id,
            'unit_id' => $unit->id,
            'role' => 'operator'
        ]);

        $ppdb = PpdbRegistration::create([
            'student_name' => 'Calon Siswa 2',
            'gender' => 'L',
            'academic_year_id' => AcademicYear::where('is_active', true)->first()->id,
            'status' => 'pending',
            'unit_id' => $unit->id,
            'entity_id' => $entity->id,
            'registration_number' => 'PPDB-2023-002'
        ]);

        $response = $this->actingAs($operator)->post(route('ppdb.approve', $ppdb));

        // Redirect to dashboard because of role middleware or unauthorized
        $response->assertRedirect(route('dashboard'));
    }
}
