<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\SppBill;
use App\Services\SppService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class SppServiceTest extends TestCase
{
    use RefreshDatabase;

    private SppService $sppService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sppService = new SppService();
    }

    public function test_it_does_not_generate_bill_before_entry_date()
    {
        $academicYear = AcademicYear::create([
            'name' => '2023/2024',
            'semester' => 'ganjil',
            'is_active' => true,
            'start_date' => '2023-07-01',
            'end_date' => '2024-06-30'
        ]);

        $entity = \App\Models\Entity::create(['name' => 'Test Entity']);
        $unit = \App\Models\Unit::create(['name' => 'MI As-Saodah', 'entity_id' => $entity->id]);

        $classroom = Classroom::create(['name' => 'Kelas 1', 'level' => 1, 'infaq_nominal' => 100000, 'unit_id' => $unit->id, 'entity_id' => $entity->id]);

        // Siswa masuk Agustus 2023
        $student = Student::create([
            'name' => 'Test Student',
            'gender' => 'L',
            'status' => 'aktif',
            'classroom_id' => $classroom->id,
            'entry_date' => '2023-08-15',
            'unit_id' => $unit->id,
            'entity_id' => $entity->id
        ]);

        // Coba generate untuk Juli 2023 (Harusnya 0 karena masuk Agustus)
        $countJuli = $this->sppService->generateMonthlyBills($academicYear, 7, 2023);
        $this->assertEquals(0, $countJuli);

        // Coba generate untuk Agustus 2023 (Harusnya 1 karena sudah masuk)
        $countAgustus = $this->sppService->generateMonthlyBills($academicYear, 8, 2023);
        $this->assertEquals(1, $countAgustus);

        $this->assertDatabaseHas('infaq_bills', [
            'student_id' => $student->id,
            'month' => 8,
            'year' => 2023,
            'nominal' => 100000
        ]);
    }
}
