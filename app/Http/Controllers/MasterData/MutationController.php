<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutationController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::orderBy('level')->orderBy('name')->get();
        
        $sourceClassroomId = $request->query('source_classroom_id');
        $students = [];
        
        if ($sourceClassroomId) {
            $students = Student::where('classroom_id', $sourceClassroomId)
                ->where('status', 'aktif')
                ->orderBy('name')
                ->get();
        }

        return view('master-data.mutations.index', compact('classrooms', 'students', 'sourceClassroomId'));
    }

    public function execute(Request $request)
    {
        $request->validate([
            'source_classroom_id' => 'required|exists:classrooms,id',
            'target_classroom_id' => 'required', // Bisa ID kelas atau string status (lulus/pindah/nonaktif)
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        $target = $request->target_classroom_id;
        $studentIds = $request->student_ids;

        DB::beginTransaction();
        try {
            if (is_numeric($target)) {
                // Mutasi ke kelas lain (Kenaikan Kelas / Pindah Ruang)
                Student::whereIn('id', $studentIds)->update([
                    'classroom_id' => $target
                ]);
                $message = count($studentIds) . " siswa berhasil dipindahkan ke kelas tujuan.";
            } else {
                // Perubahan Status Massal (Lulus / Alumni / Pindah)
                Student::whereIn('id', $studentIds)->update([
                    'status' => $target,
                    'classroom_id' => null // Lepaskan dari kelas jika sudah lulus/pindah
                ]);
                $message = count($studentIds) . " siswa berhasil diupdate statusnya menjadi " . ucfirst($target) . ".";
            }

            DB::commit();
            return redirect()->route('mutations.index', ['source_classroom_id' => $request->source_classroom_id])
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal melakukan mutasi: ' . $e->getMessage());
        }
    }
}
